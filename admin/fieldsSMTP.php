<?php

add_submenu_page(
    'theme-options',
    'E-mail / SMTP',
    'E-mail / SMTP',
    'manage_options',
    'options_smtp',
    'callback_smtp'
);

function callback_smtp(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Configurações de e-mail</h1>
            <form action="options.php" method="post">
                <?php

                    settings_fields("smtp_section");

                    do_settings_sections("options_smtp");

                    submit_button();

                ?>
            </form>

        </div>

    <?php
}

function fields_email_contato(){

    add_settings_section('contato_section','','display_emailcontato_options_content','options_smtp');

    add_settings_field('show_email_contato', 'E-mail para contato', 'display_email_contato', 'options_smtp', 'contato_section');


    register_setting('smtp_section','show_email_contato');

}
add_action('admin_init','fields_email_contato');

function display_emailcontato_options_content(){
    ?>
        <hr>
        <h2>E-mail para contato</h2>
    <?php
}

function display_email_contato(){
    ?>
        <input type="email" name="show_email_contato" id="show_email_contato" value="<?= get_option('show_email_contato') ?>">
    <?php
}

function fields_smtp(){

    add_settings_section('smtp_section','','display_smtp_options_content','options_smtp');

    add_settings_field('show_host', 'host', 'display_host', 'options_smtp', 'smtp_section');
    add_settings_field('show_smtp_username', 'username', 'display_smtp_username', 'options_smtp', 'smtp_section');
    add_settings_field('show_smtp_senha', 'senha', 'display_smtp_senha', 'options_smtp', 'smtp_section');
    add_settings_field('show_smtp_porta', 'porta', 'display_smtp_porta', 'options_smtp', 'smtp_section');
    add_settings_field('show_smtp_email', 'email', 'display_smtp_email', 'options_smtp', 'smtp_section');
    add_settings_field('show_smtp_secure', 'secure', 'display_smtp_secure', 'options_smtp', 'smtp_section');

    register_setting('smtp_section','show_host');
    register_setting('smtp_section','show_smtp_username');
    register_setting('smtp_section','show_smtp_senha');
    register_setting('smtp_section','show_smtp_porta');
    register_setting('smtp_section','show_smtp_email');
    register_setting('smtp_section','show_smtp_secure');
}
add_action('admin_init', 'fields_smtp');

function display_smtp_options_content(){
    ?>
        <hr>
        <h2>Servidor SMTP</h2>
    <?php
}

function display_host(){
    ?>
        <input type="text" name="show_host" id="show_host" value="<?= get_option('show_host') ?>">
    <?php
}

function display_smtp_username(){
    ?>
        <input type="text" name="show_smtp_username" id="show_smtp_username" value="<?= get_option('show_smtp_username') ?>">
    <?php
}

function display_smtp_senha(){
    ?>
        <input type="password" name="show_smtp_senha" id="show_smtp_senha" value="<?= get_option('show_smtp_senha') ?>">
    <?php
}

function display_smtp_porta(){
    ?>
        <input type="text" name="show_smtp_porta" id="show_smtp_porta" value="<?= get_option('show_smtp_porta') ?>">
    <?php
}

function display_smtp_email(){
    ?>
        <input type="text" name="show_smtp_email" id="show_smtp_email" value="<?= get_option('show_smtp_email') ?>">
    <?php
}

function display_smtp_secure(){
    ?>
    <style>
        .teste_conexao{
            margin: 20px 0;
        }
    </style>
        <select name="show_smtp_secure" id="show_smtp_secure" value="<?= get_option('show_smtp_secure') ?>">
            <option value="ssl/tls">ssl/tls</option>
        </select>
        <div class="teste_conexao">
            <button id="btn_test_connect">Teste conexão</button><span id="result_connect" style="margin-left: 10px;"></span>
        </div>

        <script>

            const btn_con = document.getElementById('btn_test_connect');

            btn_con.addEventListener('click', (e) => {

                e.preventDefault();

                document.getElementById('result_connect').innerHTML = "<img style='width: 22px' src='<?= get_template_directory_uri() ?>/assets/img/loading.gif'>";

                let host = document.getElementById('show_host').value;
                let username = document.getElementById('show_smtp_username').value;
                let pass = document.getElementById('show_smtp_senha').value;
                let porta = document.getElementById('show_smtp_porta').value;
                let email = document.getElementById('show_smtp_email').value;
                let secure = document.getElementById('show_smtp_secure').value;

                let params = "host="+host+"&username="+username+"&pass="+pass+"&porta="+porta+"&email="+email+"&secure="+secure;

                let xhttp = new XMLHttpRequest();

                xhttp.onload = function(){

                    document.querySelector('#result_connect').innerHTML = this.response;

                }
                xhttp.open("POST", '<?= get_template_directory_uri() ?>'+'/admin/test_smtp.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(params);
            });

        </script>

    <?php
}

?>