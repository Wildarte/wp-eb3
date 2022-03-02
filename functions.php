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
        wp_enqueue_style('post', get_template_directory_uri().'/assets/css/post.css', [] ,'1.0', 'all');
        
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


    add_theme_support('custom-fields');

    
    //get name term by slug term
    function get_nameterm_by_slugterm($slugTerm){
        $get_id_term_query = [
            'taxonomy' => 'category',
            'hide_empty' => false,
            'slug' => $slugTerm,
        ];
        $get_id_term = get_terms($get_id_term_query);

        if($get_id_term){
            return $get_id_term[0]->name;
            echo "retornou true";
        }else{
            false;
            echo "retornou false";
        }
    }


    //funcao que atribui um valor para ranking de posts 
    function wpb_set_count_post($postID, $val){
        $count_key_post = 'wpb_count_post';
        $contagem = get_post_meta($postID, $count_key_post, true);
        if($contagem == ''){
            delete_post_meta(155, $count_key_post);
            add_post_meta(155, $count_key_post, '1');
            echo "caiu no if"."<br>";
            echo "valor da variavel contagem: ".$contagem;
        }else{
            update_post_meta($postID, $count_key_post, $val);
            echo "nao caiu no if"."<br>";
        }
    }

    //function for count view more popular posts
    function wpb_set_post_views($postID) {
        $count_key = 'wpb_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }


    require('admin/fields.php');

?>