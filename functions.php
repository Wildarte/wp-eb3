<?php

    function wp_insert_scripts(){
        wp_enqueue_script('jq', get_template_directory_uri().'/assets/js/jquery-3.6.0.min.js',[], '3.6.0', true);
        wp_enqueue_script('owl-carousel-js', get_template_directory_uri().'/assets/js/owl.carousel.min.js',[], '1.0', true);
        wp_enqueue_script('script', get_template_directory_uri().'/assets/js/script.js',[], '1.0', true);
        wp_enqueue_script('form', get_template_directory_uri().'/assets/js/sform.js',[], '1.0', true);

        wp_enqueue_style('reset', get_template_directory_uri().'/assets/css/reset.css', [], '1.0', 'all');
        wp_enqueue_style('owl-caroussel', get_template_directory_uri().'/assets/css/owl.carousel.min.css', [], '1.0', 'all');
        wp_enqueue_style('owl-theme-default', get_template_directory_uri().'/assets/css/owl.theme.default.min.css', [], '1.0', 'all');
        wp_enqueue_style('m-caroussel', get_template_directory_uri().'/assets/css/m-caroussel.css', [], '1.0', 'all');
        wp_enqueue_style('style', get_template_directory_uri().'/assets/css/style.css', [], '1.0', 'all');
        
    }
    add_action('wp_enqueue_scripts', 'wp_insert_scripts');

    // Funções para Limpar o Header
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');


    // Habilitar Menus
    add_theme_support('menus');

    //add support to thumbnail post
    add_theme_support( 'post-thumbnails', ['post']);


    //add custom length to excerpt
    function my_excerpt_length($length){
        return 20;
    }
    add_filter('excerpt_length', 'my_excerpt_length');
    
    //function for custom excerpt read more
    function wpdocs_excerpt_more( $more ) {
        return '...';
    }
    add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

    // gerenciamento de logo
    function ed_custom_logo() {
        add_theme_support('custom-logo'); 
    }
    add_action('after_setup_theme', 'ed_custom_logo'); // carrega parametros de suporte do tema

    function register_my_menu(){
        register_nav_menus([
            'menu-principal' => __('Menu Principal')
        ]);
    }
    add_action('init', 'register_my_menu');


    $args_header = [
        'header-text' => true
    ];
    add_theme_support('custom-header',$args_header);

    add_theme_support('custom-fields');

    require('admin/fields.php');

?>