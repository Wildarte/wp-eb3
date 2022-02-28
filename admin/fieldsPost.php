<?php

add_submenu_page(
    'theme-options',
    'Artigos',
    'Artigos',
    'manage_options',
    'options_post',
    'callback_post'
);

function callback_post(){
    ?>

        <div>

            <?php settings_errors(); ?>
            <h1>Configuração dos posts</h1>

            <form action="options.php" method="post">
                <?php

                    settings_fields('post_section');

                    do_settings_sections('options_post');

                    submit_button()

                ?>
            </form>

        </div>

    <?php
}

function display_fields_post_top(){

    add_settings_section('post_top_section','','display_post_top_section','options_post');

    add_settings_field('show_post_top','Selecione os artigos do slider', 'display_post_top','options_post','post_top_section');
    add_settings_field('show_post_top_method','Como listar os artigos de baixo', 'display_post_top_method','options_post','post_top_section');
    add_settings_field('show_post_top_category','', 'display_post_top_category','options_post','post_top_section');

    register_setting('post_section', 'show_post_top_method');
    register_setting('post_section', 'show_post_top');
    register_setting('post_section', 'show_post_top_category');

}
add_action('admin_init', 'display_fields_post_top');

function display_post_top_section(){
    ?>
        <hr>
        <h2>Artigo em destaque (SlideShow)</h2>
    <?php
}
function display_post_top(){
    $post_top_selected = get_option('show_post_top');
    ?>
        <style>
            .content_search_post{
                position: relative;
                max-width: 580px;
            }
            .buscaPost{
                display: block;
                width: 100%;
                margin: 10px 0;
                display: flex;
                align-items: center;
                border: 1px solid #888;
                border-radius: 4px;
                background-color: #fff;
            }
            .buscaPost input{
                width: 100%;
                background-color: transparent;
                border: none;
                outline: none;
                padding: 5px;
            }
            .buscaPost input:focus{
                border: none;
                outline: none;
            }
            .buscaPost span{
                padding: 5px;
            }
            .request_post{
                position: absolute;
                top: 100%;
                border: 1px solid #999;
                width: 100%;
                background-color: #fff;
            }
            .request_post option{
                width: 100%;
                border: 1px solid;
                margin: 2px 0;
            }
            .request_post option:hover{
                cursor: pointer;
                background-color: #444;
                color: #fff;
            }

            .posts_selected{
                border: 1px solid #333;
                border-radius: 5px;
                background-color: #333;
                max-width: 580px;
                padding: 2px;
                color: #fff;
            }
            .posts_selected span{
                font-size: 1.2em;
                padding: 1px 3px;
            }
            .posts_selected span:hover{
                cursor: pointer;
            }
            .posts_selected input{
                padding: 1px;
            }
            .loading-img{
                display: none;
                width: 32px;
            }
            .loading-img img{
                width: 100%;
            }
            .show-loading-img{
                display: block;
            }
        </style>

        <div class="posts_selected">
            <?php

                if(!empty($post_top_selected)){
                    for($i = 0; $i < count($post_top_selected); $i++){
                        echo '<input type="text" name="show_post_top[]" value="'.$post_top_selected[$i].'" readonly><span class="delet_item">X</span>';
                    }
                }

            ?>
        </div>
        
        <div class="content_search_post">
            <div class="buscaPost">
                <input type="search" class="busca_post" name="busca_post" id="busca_post" onkeyup="buscaPost('<?= get_template_directory_uri() ?>')" placeholder="Buscar Artigos...">
                <span class="dashicons dashicons-search"></span>
            </div>
            <div class="request_post">
                <div class="loading-img">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/loading.gif" alt="">
                </div>
                <div class="request_post_content">

                </div>
            </div>
        </div>
        <script src="<?= get_template_directory_uri() ?>/admin/posts.js"></script>
        <script>
            const opts = document.getElementsByClassName('option-single-post');
            const bts_delet = document.getElementsByClassName('delet_item');

            function inputPost(classe){
                console.log(this.value);

                let pt = document.getElementById('post-'+classe);

                let sp = document.createElement('span');
                sp.setAttribute('class', 'delet_item');
                sp.innerText = "X";

                sp.addEventListener('click', deleteItem);

                let inp = document.createElement('input');
                inp.setAttribute('type', 'text');
                inp.setAttribute('name', 'show_post_top[]');
                inp.setAttribute('value', pt.value);
                inp.setAttribute('readonly','readonly');

                document.querySelector('.posts_selected').append(inp);
                document.querySelector('.posts_selected').append(sp);
            }

            for(let i = 0; i < opts.length; i++){
                opts[i].addEventListener('click', function(){
                    console.log(this.value);

                    alert('test');

                    let sp = document.createElement('span');
                    sp.setAttribute('class', 'delet_item');
                    sp.innerText = "X";

                    sp.addEventListener('click', deleteItem);

                    let inp = document.createElement('input');
                    inp.setAttribute('type', 'text');
                    inp.setAttribute('name', 'show_post_top[]');
                    inp.setAttribute('value', this.value);
                    inp.setAttribute('readonly','readonly');

                    document.querySelector('.posts_selected').append(inp);
                    document.querySelector('.posts_selected').append(sp);
                });
            }
            
            function deleteItem(){
                this.previousElementSibling.remove();
                this.remove();  
            }

            for(let i = 0; i < bts_delet.length; i++){
                bts_delet[i].addEventListener('click', deleteItem);
            }

        </script>
        <!-- 
        <select class="" name="show_post_top[]" multiple id="show_post_top">
            <option value=""></option>
            <option value="um" selected>um</option>
            <option value="dois" selected>dois</option>
            <option value="tres">tres</option>
            <option value="quatro">quatro</option>

            <?php
            /*
                $args_post_destaque = [
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => -1
                ];
                $result_post_destaque = new WP_query($args_post_destaque);

            if($result_post_destaque->have_posts()): while($result_post_destaque->have_posts()): $result_post_destaque->the_post(); ?>
                <option value="<?= get_the_ID(); ?>" <?= $post_top_selected == get_the_ID() ? "selected" : "" ?>><?= the_title(); ?></option>
            <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); */?>
        </select>
        -->
        <script>
            


        </script>
    <?php
}

function display_post_top_method(){
    $get_method = get_option('show_post_top_method');
    ?>
        <select name="show_post_top_method" id="show_post_top_method">
            <option value="lastPost" <?= $get_method == "lastPost" ? "selected" : ""; ?>>Últimos Artigos</option>
            <option value="category" <?= $get_method == "category" ? "selected" : ""; ?>>Categoria</option>
            <option value="moreread" <?= $get_method == "moreread" ? "selected" : ""; ?>>Mais Lidos</option>
        </select>
    <?php
}
function display_post_top_category(){
    $get_method_post = get_option('show_post_top_method');
    $get_cat = get_option('show_post_top_category');

    ?>
        <select name="show_post_top_category" id="show_post_top_category" style="display:<?= $get_method_post == "category" ? "display" : "none" ?>">
        ddasfsfsdfsd
            <?php $name_term = get_nameterm_by_slugterm($get_cat); ?>
            
            <?php //$term_id = get_idterm_by_slugterm($get_cat); ?>
            <?php
                $terms = get_terms([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                    //'exclude' => $term_id
                ]);
                foreach($terms as $term){
                    if($term->slug == $get_cat){
                    echo "<option value='".$term->slug."' selected >".$term->name. "</option>";      
                    }else{
                        echo "<option value='".$term->slug."' >".$term->name. "</option>";      
                    }
                }
                
            ?>
        </select>
        <script>
            const me = document.getElementById('show_post_top_method');
            const selec_cat = document.getElementById('show_post_top_category');

            console.log(selec_cat);

            me.addEventListener('change', function(){
                if(me.value == "category"){
                    selec_cat.style.display = "inline-block";
                }
            });
        </script>
    <?php
}

?>