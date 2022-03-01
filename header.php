<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php bloginfo('name'); ?></title>
    <!-- wp  head -->
    <?php wp_head() ?>
    <!-- wp head -->
    <?php $color_global = get_option('show_cor_geral'); ?>
    
<style> <?php $color_global != "" ? ":root{ --cor-main: <?= ".$color_global."; ?>}" : ""; ?> </style>
</head>
<body>
    
    <header class="header">
        <div class="header_content container">
            <a class="link_logo_home" href="<?= get_home_url(); ?>">
                <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                ?>
                <img src="<?=  esc_url( $logo[0] )  ?>" alt="logo do site">
            </a>
            <div class="btn_mobile">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar3"></span>
            </div>
            <nav class="menu">
                <div class="top_menu_mobile">
                    <span class="btn_close_menu_mobile" id="btn_close_menu_mobile">
                        <i class="bi bi-x-square"></i>
                    </span>
                </div>
                <?php

                    wp_nav_menu([
                        'menu' => 'menu principal',
                        'theme_location' => 'menu-principal',
                        'container' => false
                    ])

                ?>
            </nav>
            <div class="header_right">
                <div class="form_search_header">
                    <form action="" method="post">
                        <input type="search" name="s" id="" placeholder="Pesquisar...">
                        <button type="submit" class="bi bi-search"></button>
                        <i class="bi bi-search focus-search"></i>
                    </form>
                </div>
                <div class="cta_header">
                    <?php
                            $text_cta = get_option('show_text_cta');
                            $link_cta = get_option('show_link_cta');

                            if($text_cta):
                    ?>
                    <a href="<?= get_option('show_link_cta') ?>"><?= get_option('show_text_cta') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>