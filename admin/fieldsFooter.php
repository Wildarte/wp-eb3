<?php

add_submenu_page(
    'theme-options',
    'Rodapé',
    'Rodapé',
    'manage_options',
    'options_footer',
    'callback_footer'
);

function callback_footer(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Informações do Rodapé</h1>
            <form action="options.php" method="post">
                <?php

                    settings_fields("footer_section");

                    do_settings_sections("options_footer");

                    submit_button();

                ?>
            </form>

        </div>

    <?php
}

function display_fields_footer(){

    add_settings_section('footer_section','','display_footer_options_content','options_footer');

    add_settings_field('show_footer_title', 'Título rodapé', 'display_footer_title', 'options_footer', 'footer_section');
    add_settings_field('show_footer_subtitle', 'SubTítulo Rodapé', 'display_footer_subtitle', 'options_footer', 'footer_section');


    register_setting('footer_section','show_footer_title');
    register_setting('footer_section','show_footer_subtitle');
    
}
add_action('admin_init', 'display_fields_footer');

function display_footer_options_content(){
    ?>
        <hr>
        <h2>Título e Subtítulo</h2>
    <?php
}

function display_footer_title(){
    ?>
            <input type="text" style="width: 480px;" name="show_footer_title" id="show_footer_title" value="<?= get_option('show_footer_title') ?>">
    <?php
}

function display_footer_subtitle(){
    ?>
            <input type="text" style="width: 680px;" name="show_footer_subtitle" id="show_footer_subtitle" value="<?= get_option('show_footer_subtitle') ?>">
    <?php
}

?>