<?php

add_submenu_page(
    'theme-options',
    'Geral',
    'Geral',
    'manage_options',
    'options_geral',
    'callback_geral'
);

function callback_geral(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Configurações Gerais</h1>
            <form action="options.php" method="post">
                <?php

                    settings_fields("geral_section");

                    do_settings_sections("options_geral");

                    submit_button();

                ?>
            </form>

        </div>

    <?php
}

function display_fields_geral(){

    add_settings_section('geral_section','','display_geral_options_content','options_geral');

    add_settings_field('show_link_politica', 'link políticas de pricidade', 'display_link_politica', 'options_geral', 'geral_section');
    add_settings_field('show_cor_geral', 'Cor Geral', 'display_cor_geral', 'options_geral', 'geral_section');
    add_settings_field('show_title_home', 'Título cabeçalho home', 'display_title_home', 'options_geral', 'geral_section');
    add_settings_field('show_subtitle_home', 'Subtítulo cabeçalho home', 'display_subtitle_home', 'options_geral', 'geral_section');
    add_settings_field('show_description_home', 'Subtítulo cabeçalho home', 'display_description_home', 'options_geral', 'geral_section');

    register_setting('geral_section','show_link_politica');
    register_setting('geral_section','show_cor_geral');
    register_setting('geral_section','show_title_home');
    register_setting('geral_section','show_subtitle_home');
    register_setting('geral_section','show_description_home');

}
add_action('admin_init', 'display_fields_geral');

function display_geral_options_content(){
    ?>
        <hr>
        <h2>Redes Sociais</h2>
    <?php
}

function display_link_politica(){
    ?>
        <input type="url" name="show_link_politica" id="show_link_politica" value="<?= get_option('show_link_politica'); ?>">
    <?php
}

function display_cor_geral(){
    $cor_geral = get_option('show_cor_geral');
    ?>
        <style>
            .btn_cor_geral{
                display: inline;
                border: none;
                height: 27px;
                width: 27px;
                padding: 2px;
                border: 1px solid #333;
                border-radius: 50%;
                color: #000;
                font-size: 1.4em;
                font-weight: 600;
            }
            .btn_cor_geral:hover{
                cursor: pointer;
            }
        </style>

        <input type="color" name="show_cor_geral" id="show_cor_geral" value="<?= $cor_geral == "" ? "#AE0032" : $cor_geral; ?>">
        <span class="btn_cor_geral">&#8635;</span>
        <script>
            document.querySelector(".btn_cor_geral").addEventListener("click", function(){
                document.getElementById("show_cor_geral").value = "#AE0032";
            });
        </script>
    <?php
}

function display_title_home(){
    ?>
        <input type="text" name="show_title_home" id="show_title_home" value="<?= get_option('show_title_home'); ?>">
    <?php
}

function display_subtitle_home(){
    ?>
        <input type="text" name="show_subtitle_home" id="show_subtitle_home" value="<?= get_option('show_subtitle_home'); ?>">
    <?php
}

function display_description_home(){
    ?>
        <textarea rows="5" cols="30" name="show_description_home" id="show_description_home" ><?= get_option('show_description_home'); ?></textarea>
    <?php
}

?>