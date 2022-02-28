<?php

add_submenu_page(
    'theme-options',
    'Anúncios',
    'Anúncios',
    'manage_options',
    'options_ads',
    'callback_ads'
);

function callback_ads(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Adicone images de anúncios</h1>
            <form action="options.php" method="post">
                <?php

                    settings_fields("ads_section");

                    do_settings_sections("options_ads");

                    submit_button();

                ?>
            </form>

        </div>

    <?php
}

function display_fields_ads(){

    add_settings_section('ads_section','','display_ads_options_content','options_ads');

    add_settings_field('show_ads_images', 'Selecionar imagem', 'display_ads_images', 'options_ads', 'ads_section');

    register_setting('ads_section','show_ads_images');
    
}
add_action('admin_init', 'display_fields_ads');

function display_ads_options_content(){
    ?>
        <hr>
        <h1>Anúncios</h1>
    <?php
}

function display_ads_images(){
    $ads_posted = get_option('show_ads_images');
    ?>
    <style>
        .ads input{
            display: block;
            margin: 5px 0;
        }
        .ads_table{
            display: flex;
            flex-wrap: wrap;
        }
        .header_ads{
            width: 100%;
            border-bottom: 1px solid #777;
        }
        .ads_table .ads_left{
            flex-basis: 30%;
            display: flex;
        }
        .ads_table .ads_right{
            flex-basis: 70%;
            display: flex;
        }
        .ads_table .ads_left img{
            width: 40%;
            margin: auto;
        }
    </style>
        <div class="ads">


        <!-- ====================== IMG ===================== -->


        <?php $id_image = get_option(''); ?>
        <!--
        <img src="<?= wp_get_attachment_image_url( $id_image, 'thumbnail' ); ?>" alt="" srcset="">
        -->
        
        <?php
    if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST[''] ) ) :
        update_option( '', absint( $_POST[''] ) );
    endif;
    wp_enqueue_media();
    ?>
        <div class='image-preview-wrapper'>
            <img class="img_to_ads"  style="max-width: 380px" id='image-preview' src='<?php echo wp_get_attachment_url( get_option( '' ) ); ?>' width='200'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='' id='' value='<?php echo get_option( '' ); ?>'>
        <!-- 
        <input type="submit" name="submit_image_selector" value="Salvar" class="button-primary">
        -->
    
    <script type='text/javascript'>
        jQuery( document ).ready( function( $ ) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
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
                    $( '#' ).val( attachment.id );
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


        <!-- ================== IMG ====================== -->


            <!-- 
            <input type="text" class="img" name="show_ads_images[0][0]" id="show_ads_images" value="">
             -->
            <input type="text" class="link" name="show_ads_images[0][1]" id="show_ads_images" value="">
        </div>
       

        <button id="add_intem">
            Add
        </button>

        <div class="ads_table">
            <div class="header_ads">
                <h2>Anúncios</h2>
            </div>
            <div class="ads_left">
                <h3>IMAGEM</h3>
            </div>
            <div class="ads_right">
                <h3>LINK</h3>
            </div>
        </div>
    <script>
        let item = 0;
        let subitem = 0;

        const btn_add = document.getElementById('add_intem');
        let ads_table = document.querySelector('.ads_table');


        btn_add.addEventListener('click', function(e){
            e.preventDefault();

            let div_left = document.createElement('div');
            div_left.setAttribute('class','ads_left');

            const img_ads = document.querySelector('.img_to_ads');
            img_ads.getAttribute('src');

            let input_img = document.createElement('input');
            input_img.setAttribute('type', 'hidden');
            input_img.setAttribute('name', 'how_ads_images[][]');
            input_img.setAttribute('value', img_ads.getAttribute('src'));

            div_left.innerHTML = `<img src="${img_ads.getAttribute('src')}">`;

            ads_table.append(div_left);
        });

        /*
        document.getElementById('add_intem').addEventListener('click', function(e){
            e.preventDefault();

            item++;

            let input = document.createElement('input');
            input.setAttribute('type','text');
            input.setAttribute('class', 'img');
            input.setAttribute('name', `show_ads_images[${item}][${subitem}]`);
            input.setAttribute('id','show_ads_images');

            subitem++;

            let link = document.createElement('input');
            link.setAttribute('type','text');
            link.setAttribute('class', 'link');
            link.setAttribute('name', `show_ads_images[${item}][${subitem}]`);
            link.setAttribute('id','show_ads_images');

            document.querySelector('.ads').append(input);
            document.querySelector('.ads').append(link);
        });
        */
    </script>
    <?php
}