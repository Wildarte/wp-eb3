<?php

add_submenu_page(
    'theme-options',
    'Contato',
    'Contato',
    'manage_options',
    'options_contato',
    'callback_contato'
);

function callback_contato(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Configurações de contato</h1>
            <form action="options.php" method="post">
                <?php

                    settings_fields("contato_section");

                    do_settings_sections("options_contato");

                    submit_button();

                ?>
            </form>

        </div>

    <?php
}
/*
function display_fields_contato(){

    add_settings_section("contato_section","","display_contato_options_content", "options_contato");

    add_settings_field("show_telefone", "Telefone", "display_contato_telefone", "options_contato","contato_section");
    add_settings_field("show_email", "email", "display_contato_email", "options_contato","contato_section");

    register_setting("contato_section", "show_telefone");
    register_setting("contato_section", "show_email");

}
add_action("admin_init", "display_fields_contato");
*/

function display_contato_options_content(){
    ?>
        <hr>
        <h2>Configuração da Contatos</h2>
    <?php
}

function display_contato_telefone(){
    ?> <span class='dashicons dashicons-phone'></span>
        <input type="text" name="show_telefone" id="show_telefone" value="<?= get_option("show_telefone") ?>" maxlength="15">
        <script>
            /* Máscaras ER */
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('show_telefone').onkeyup = function(){
                    mascara( this, mtel );
                }
            }
        </script>
    <?php
}
function display_contato_email(){
    ?> <span class='dashicons dashicons-email'></span>
        <input type="email" name="show_email" id="show_email" value="<?= get_option("show_email") ?>">
    <?php
}



function display_fields_social(){

    add_settings_section("social_section","","display_social_options_content", "options_contato");

    add_settings_field("show_facebook", "facebook ", "display_contato_facebook", "options_contato","social_section");
    add_settings_field("show_instagram", "instagram", "display_contato_instagram", "options_contato","social_section");
    add_settings_field("show_linkedin", "linkedin", "display_contato_linkedin", "options_contato","social_section");
    add_settings_field("show_twitter", "twitter", "display_contato_twitter", "options_contato","social_section");
    add_settings_field("show_whatsapp", "whatsapp", "display_contato_whatsapp", "options_contato","social_section");
    add_settings_field("show_tiktok", "tiktok", "display_contato_tiktok", "options_contato","social_section");

    register_setting("contato_section", "show_facebook");
    register_setting("contato_section", "show_instagram");
    register_setting("contato_section", "show_linkedin");
    register_setting("contato_section", "show_twitter");
    register_setting("contato_section", "show_whatsapp");
    register_setting("contato_section", "show_tiktok");

}
add_action("admin_init", "display_fields_social");

function display_social_options_content(){
    ?>
        <hr>
        <h2>Redes sociais</h2>
    <?php
}

function display_contato_facebook(){
    ?> <span class='dashicons dashicons-facebook'></span>
        <input type="url" name="show_facebook" id="show_facebook" value="<?= get_option('show_facebook') ?>">
    <?php
}

function display_contato_instagram(){
    ?> <span class='dashicons dashicons-instagram'></span>
        <input type="url" name="show_instagram" id="show_instagram" value="<?= get_option('show_instagram') ?>">
    <?php
}

function display_contato_linkedin(){
    ?> <span class='dashicons dashicons-linkedin'></span>
        <input type="url" name="show_linkedin" id="show_linkedin" value="<?= get_option('show_linkedin') ?>">
    <?php
}

function display_contato_twitter(){
    ?> <span class='dashicons dashicons-twitter'></span>
        <input type="url" name="show_twitter" id="show_twitter" value="<?= get_option('show_twitter') ?>">
    <?php
}

function display_contato_whatsapp(){
    ?> <span class='dashicons dashicons-whatsapp'></span>
        <input type="url" name="show_whatsapp" id="show_whatsapp" value="<?= get_option('show_whatsapp') ?>">
    <?php
}

function display_contato_tiktok(){
    ?> <span class='dashicons dashicons-tiktok'></span>
        <input type="url" name="show_tiktok" id="show_tiktok" value="<?= get_option('show_tiktok') ?>">
    <?php
}


?>