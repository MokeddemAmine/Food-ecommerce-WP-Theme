<?php 
/**
 * All our header stuff comes here
 */
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
</head>
<body>
    <div class="upper-bar my-2">
        <div class="container-fluid bg-main py-2">
            <div class="row d-flex align-items-center">
                <div class="col-9 text-center">
                    <p class="m-0">Food festival | 1st july - 31 august | Enjoy Free Delivery, Big Deals, small ka-money Discounts up to -50%</p>
                </div>
                <div class="col-3">
                    <button class="btn btn-light fw-bold text-uppercase">stay connected</button>
                </div>
            </div>
        </div>
    </div>
    <header>
        <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id,'full');
            if(has_custom_logo()){
                echo '<img src="'. esc_url($logo[0]) .'" alt="'.get_bloginfo('name').'">';
            }else{
                echo '<h1>'. get_bloginfo('name') .'</h1>';
            }
        ?>
    </header>
    
