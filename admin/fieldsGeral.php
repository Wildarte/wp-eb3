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

    add_settings_field('show_cor_geral', 'Cor Geral', 'display_cor_geral', 'options_geral', 'geral_section');
    add_settings_field('show_title_home', 'Título cabeçalho home', 'display_title_home', 'options_geral', 'geral_section');
    add_settings_field('show_subtitle_home', 'Subtítulo cabeçalho home', 'display_subtitle_home', 'options_geral', 'geral_section');
    add_settings_field('show_description_home', 'Subtítulo cabeçalho home', 'display_description_home', 'options_geral', 'geral_section');
    add_settings_field('show_image_home', 'Imagem do cabeçalho', 'display_image_home', 'options_geral', 'geral_section');
    add_settings_field('show_link_politica', 'link políticas de pricidade', 'display_link_politica', 'options_geral', 'geral_section');


    register_setting('geral_section','show_cor_geral');
    register_setting('geral_section','show_title_home');
    register_setting('geral_section','show_subtitle_home');
    register_setting('geral_section','show_description_home');
    register_setting('geral_section','show_image_home');
    register_setting('geral_section','show_link_politica');
    

}
add_action('admin_init', 'display_fields_geral');

function display_geral_options_content(){
    ?>
        <hr>
        <h1>Informações da Página Home</h1>
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

function display_image_home(){
    ?>

<?php $id_image = get_option('show_image_home'); ?>
        <!--
        <img src="<?= wp_get_attachment_image_url( $id_image, 'thumbnail' ); ?>" alt="" srcset="">
        -->
        
        <?php
if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['show_image_home'] ) ) :
        update_option( 'show_image_home', absint( $_POST['show_image_home'] ) );
    endif;
    wp_enqueue_media();
    ?>
        <div class='image-preview-wrapper'>
            <img  style="max-width: 380px" id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'show_image_home' ) ); ?>' width='200'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='show_image_home' id='show_image_home' value='<?php echo get_option( 'show_image_home' ); ?>'>
        <input type="submit" name="submit_image_selector" value="Salvar" class="button-primary">
    
<?php


$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
    ?><script type='text/javascript'>
        jQuery( document ).ready( function( $ ) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
            jQuery('#upload_image_button').on('click', function( event ){
                event.preventDefault();
                // If the media frame already exists, reopen it.
                
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Selecione a imagem',
                    button: {
                        text: 'Usar imagem',
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on( 'select', function() {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                    $( '#show_image_home' ).val( attachment.id );
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                    // Finally, open the modal
                    file_frame.open();
            });
            // Restore the main ID when the add media button is pressed
            jQuery( 'a.add_media' ).on( 'click', function() {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script>
    

    <?php
}

function display_fields_cta(){

    add_settings_section('cta_section','','display_cta_options_content','options_geral');

    add_settings_field('show_text_cta', 'Título cabeçalho home', 'display_text_cta', 'options_geral', 'cta_section');
    add_settings_field('show_link_cta', 'link do CTA', 'display_link_cta', 'options_geral', 'cta_section');


    register_setting('geral_section','show_text_cta');
    register_setting('geral_section','show_link_cta');
    
}
add_action('admin_init', 'display_fields_cta');

function display_cta_options_content(){
    ?>
        <hr>
        <h1>Configurações do CTA</h1>
    <?php
}
function display_text_cta(){
    ?>
        <input type="text" name="show_text_cta" id="show_text_cta" value="<?= get_option('show_text_cta') ?>">
    <?php
}

function display_link_cta(){
    ?>
        <input type="url" style="width: 500px;" name="show_link_cta" id="show_link_cta" value="<?= get_option('show_link_cta'); ?>">
    <?php
}

function display_fields_newsletter(){

    add_settings_section('news_section','','display_news_options_content','options_geral');

    add_settings_field('show_title_newsletter', 'Título news letter', 'display_title_newsletter', 'options_geral', 'news_section');
    add_settings_field('show_subtitle_newsletter', 'Subtítulo news letter', 'display_subtitle_newsletter', 'options_geral', 'news_section');


    register_setting('geral_section','show_title_newsletter');
    register_setting('geral_section','show_subtitle_newsletter');
    
}
add_action('admin_init', 'display_fields_newsletter');

function display_news_options_content(){
    ?>
        <hr>
        <h1>News Letter</h1>
    <?php
}

function display_title_newsletter(){
    ?>
        <input type="text" name="show_title_newsletter" id="show_title_newsletter" value="<?= get_option('show_title_newsletter') ?>">
    <?php
}

function display_subtitle_newsletter(){
    ?>
        <input type="text" style="width: 580px;" name="show_subtitle_newsletter" id="show_subtitle_newsletter" value="<?= get_option('show_subtitle_newsletter') ?>">
    <?php
}

?>