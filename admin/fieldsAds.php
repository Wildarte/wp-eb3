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

    add_settings_field('show_ads_images', 'Parâmetros do anúncio', 'display_ads_images', 'options_ads', 'ads_section');

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
        .row_ads .ads_left{
            flex-basis: 15%;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .row_ads .ads_right{
            flex-basis: 80%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .row_ads .ads_right{
            width: 100%;
        }
        .row_ads .ads_left img{
            width: 80%;
        }
        .row_ads_top{
            display: flex;
            flex-basis: 100%;
            margin: 5px 0;
        }
        .row_ads_top .ads_left{
            flex-basis: 15%;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .row_ads_top .ads_right{
            flex-basis: 80%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .row_ads{
            display: flex;
            flex-basis: 100%;
            margin: 5px 0;
        }
        .delete_row_ads{
            flex-basis: 5%;
            display: flex;
            justify-content: center;
            align-content: center;
        }
        .delete_row_ads span{
            margin: auto;
            font-size: 2em;
            color: red;
        }
        .delete_row_ads span:hover{
            cursor: pointer;
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
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Selecionar imagem' ); ?>" />
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
            <input type="text" style="width: 580px" class="link_ads" name="" id="" value="" placeholder="link...">
        </div>
       

        <button id="add_item">
            Adicionar
        </button>

        <div class="ads_table">
        <div class="header_ads">
                    <h2>Anúncios</h2>
                </div>
            <div class="row_ads_top">
                <div class="ads_left">
                    <h3>IMAGEM</h3>
                </div>
                <div class="ads_right">
                    <h3>LINK</h3>
                </div>
            </div>
            
           

            <?php

                $ads_posted = get_option('show_ads_images');

                if(is_array($ads_posted)) $total_ads = count($ads_posted);
                
                
                for($item = 0; $item < $total_ads; $item++){
                    echo "<div class='row_ads' id='row_ads'>";
                    for($subitem = 0; $subitem <= 1; $subitem++){
                        if($subitem == 0){
                            ?>
                                <div class="ads_left">
                                    <img src="<?= $ads_posted[$item][$subitem]; ?>" alt=""><br>
                                    <input type="hidden" class="ads_input_img" name="show_ads_images[<?= $item ?>][<?= $subitem ?>]" value="<?= $ads_posted[$item][$subitem]; ?>">
                                </div>
                            <?php
                        }else 
                            if($subitem == 1){
                            ?>
                                <div class="ads_right">
                                    <input type="text" style="width: 100%;" class="ads_input_link" name="show_ads_images[<?= $item ?>][<?= $subitem ?>]" id="" readonly value="<?= $ads_posted[$item][$subitem]; ?>">
                                </div>
                            <?php
                        }
                    }
                    echo "<div class='delete_row_ads' id='delete_row_ads'><span class='dashicons dashicons-no action_close_ads'></span></div>";
                    echo "</div>";
                }
            ?>
        </div>
    <script>
        let total_de_ads = document.getElementsByClassName('row_ads').length;
        console.log("total de anúncios: "+total_de_ads);
        let item = total_de_ads;
        let subitem = 0;

        const btn_add = document.getElementById('add_item');
        let ads_table = document.querySelector('.ads_table');
        const deletAds = document.getElementsByClassName('delete_row_ads');


        const img_ads = document.querySelector('.img_to_ads');//seleciona a imagem do anúncio
        const link_ads = document.querySelector('.link_ads');//seleciona o link do aúncio


        btn_add.addEventListener('click', function(e){
            e.preventDefault();

            if(img_ads.getAttribute('src') == ""){
                alert('Selecione uma imagem');
            }else if(link_ads.value == ""){
                alert('Selecione um link para o anúncio');
            }else{

                //cria a linha de cada anuncio na tabela
                let div_row_ads = document.createElement('div');
                div_row_ads.setAttribute('class','row_ads');

                //cria o elemento da div left
                let div_left = document.createElement('div');
                div_left.setAttribute('class','ads_left');

                //cria um input hidden com a url da imagem que será usada no anúncio
                let input_img = document.createElement('input');
                input_img.setAttribute('type', 'hidden');
                input_img.setAttribute('class','ads_input_img');
                input_img.setAttribute('name', 'show_ads_images['+item+'][0]');
                input_img.setAttribute('readonly','readonly');
                input_img.setAttribute('value', img_ads.getAttribute('src'));

                div_left.innerHTML = `<img src="${img_ads.getAttribute('src')}"><br>`;//insere o elemento de imagem na div_left criada


                //agora cria o elemento de div da direita
                let div_right = document.createElement('div');
                div_right.setAttribute('class', 'ads_right');

                let input_link = document.createElement('input');
                input_link.setAttribute('type', 'text');
                input_link.setAttribute('class', 'ads_input_link')
                input_link.setAttribute('name','show_ads_images['+item+'][1]');
                input_link.setAttribute('value', link_ads.value);
                input_link.setAttribute('readonly','readonly');
                input_link.setAttribute('style', 'width: 100%');
                
                
                let div_close = document.createElement('div');
                div_close.setAttribute('class','delete_row_ads');
                div_close.innerHTML = "<span class='dashicons dashicons-no action_close_ads'></span>";
                div_close.addEventListener('click', removeRowAds);

                div_left.append(input_img);
                div_row_ads.append(div_left);

                div_right.append(input_link);
                div_row_ads.append(div_right);

                ads_table.append(div_row_ads);

                div_row_ads.append(div_close);

                img_ads.setAttribute('src','');
                link_ads.value = "";

                item++;

            }
            
        });
        

        //função usada para remover anuncio quando clicar no botão X de deletar
        function removeRowAds(e){
            if(confirm('Deseja remover o anúncio')){
                e.currentTarget.parentElement.remove();

                const rows_img = document.getElementsByClassName('ads_input_img');
                const rows_link = document.getElementsByClassName('ads_input_link');
            
                for(let i = 0; i < rows_img.length; i++){
                    rows_img[i].setAttribute('name','show_ads_images['+i+'][0]');
                    rows_link[i].setAttribute('name','show_ads_images['+i+'][1]');
                }
                
            }
        }


        //atribui a todos os botões de excluir anúncio a função para excluir o anúncio
        for(let i = 0; i < deletAds.length; i++){
            deletAds[i].addEventListener('click', removeRowAds);
        }

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