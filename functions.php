<?php 

    function techiepress_theme_setup(){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-background');
        add_theme_support('custom-header',array(
            'flex-width'    => true,
            'width'         => 1200,
            'flex-height'   => true,
            'height'        => 300,
            'default-image' => get_template_directory_uri().'/assets/imgs/header.jpg',
        ));
        add_theme_support('automatic-feed-links');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo',array(
            'height'        => 50,
            'width'         => 50,
            'flex-height'   => true,
            'flex-width'    => true,
            'header-text'   => array('site-title','site-description'),
        ));
        add_theme_support('html5',array('comment-list','comment-form','search-form','gallery','caption','style','script'));
    }
    add_action('after_setup_theme','techiepress_theme_setup');

    // enqueue scripts and styles
    add_action('wp_enqueue_scripts','add_scripts');
    function add_scripts(){
        // add fonts
        wp_enqueue_style('new-zealand-font','https://fonts.googleapis.com/css2?family=Playwrite+NZ:wght@100..400&display=swap');
        // add style files
        wp_enqueue_style('fontawsome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css');
        wp_enqueue_style('bootstrap-css','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css','','1.0.0','all');

        wp_enqueue_style('main-css',get_template_directory_uri().'/assets/css/main.css','','1.0.0','all');

        // add scripts files
        wp_enqueue_script('bootstrap-jquery','https://code.jquery.com/jquery-3.7.1.min.js',array(),false,true);
        wp_enqueue_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',array('bootstrap-jquery'),false,true);
        wp_enqueue_script('bootstrap-js','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js',array('bootstrap-jquery'),false,true);
    }