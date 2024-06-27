<?php get_header(); ?>

<div class="container-fluid m-0 my-3 p-0">
    <div class="header-image">
        <img alt="header food" class="image-fluid" src="<?php header_image(); ?>" />
    </div>
</div>

<div class="container py-2">
    <div class="row">
        <div class="col-8">
            <?php
                $products_cats = array();

                $args = array(
                    'post_type'         => 'product',
                    'posts_per_page'    => -1,
                );

                $products = new WP_Query($args);

                if($products->have_posts()){
                    while($products->have_posts()){
                        $products->the_post();

                        $products_categories = get_the_terms(get_the_id(),'product_cat');

                        foreach($products_categories as $product_cat){
                            if(! in_array($product_cat->name,$products_cats,true)){
                                array_push($products_cats,$product_cat->name);
                            }
                        }
                    }
                    ?>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php
                                foreach($products_cats as $key => $product_cat){
                                    ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if($key == 0) echo 'active'; ?>" data-toggle="tab" aria-selected="true" aria-current="page" href="#<?php echo $product_cat ?>"><?php echo $product_cat ?></a>
                                        </li>
                                    <?php
                                }
                            ?>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <?php 
                                foreach($products_cats as $key => $product_cat){
                                    ?>
                                        <div class="tab-pane fade  <?php if($key==0) echo 'show active'; ?>" id="<?php echo $product_cat ?>" role="tabpanel">
                                        <?php
                                            $args = array(
                                                'post_type'         => 'product',
                                                'posts_per_page'    => -1,
                                                'tax_query'         => array(
                                                    array(
                                                        'taxonomy'  => 'product_cat',
                                                        'field'     => 'slug',
                                                        'terms'     => array($product_cat),
                                                        'operator'  => 'IN',
                                                    )
                                                ),
                                            );

                                            $div_products = new WP_Query($args);

                                            if($div_products->have_posts()){
                                                while($div_products->have_posts()){
                                                    $div_products->the_post();

                                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumbnail');
                                                    ?>
                                                        <div class="row p-2 my-3">
                                                            <div class="col-4">
                                                                <img src="<?php echo $image[0]; ?>" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <h3><?php echo get_the_title(); ?></h3>
                                                                <p><?php echo get_the_title(); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    wc_get_template('loop/add-to-cart.php');
                                                }
                                            }
                                            wp_reset_postdata();
                                        ?>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    <?php
                }else{
                    esc_attr_e('No products listed in the Admin','food-restaurant');
                }
                wp_reset_postdata();
            ?>
            
        </div>
        <div class="col-4">
            <span class="w-50 ml-auto bg-main d-inline-block text-capitalize">mini cart</span>
        </div>
    </div>
</div>

<?php get_footer(); ?>