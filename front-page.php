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
                                                            <div class="col-3">
                                                                <img src="<?php echo $image[0]; ?>" alt="<?php echo wp_get_attachment_caption(get_the_ID()) ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <h3><?php echo get_the_title(); ?></h3>
                                                                <p><?php echo get_the_title(); ?></p>
                                                            </div>
                                                            <div class="col-3 d-flex flex-column justify-content-end">
                                                                <span class="d-inline-block mb-3 d-flex align-items-center justify-content-between">
                                                                    <?php wc_get_template('loop/price.php'); ?>
                                                                    <?php wc_get_template('loop/add-to-cart.php'); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    
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
            <span class="mini-cart w-50 ml-auto bg-main d-inline-block text-capitalize">
                <div class="widget_shopping_cart_content">
                    <?php
                        woocommerce_mini_cart();
                        // wc_get_template('cart/mini-cart.php');
                    ?>
                </div>
            </span>
        </div>
    </div>
</div>

<?php get_footer(); ?>