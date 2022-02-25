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

    add_settings_field('show_post_top_method','Selecione o método de listagem', 'display_post_top_method','options_post','post_top_section');
    add_settings_field('show_post_top','Selecione o Artigo', 'display_post_top','options_post','post_top_section');

    register_setting('post_section', 'show_post_top_method');
    register_setting('post_section', 'show_post_top');

}
add_action('admin_init', 'display_fields_post_top');

function display_post_top_section(){
    ?>
        <hr>
        <h2>Artigo em destaque (SlideShow)</h2>
    <?php
}
function display_post_top_method(){
    ?>
        <select name="show_post_top_method" id="show_post_top_method">
            <option value="lastPost">Últimos Artigos</option>
            <option value="category">Categoria</option>
            <option value="keyword">Palavra-chave</option>
            <option value="moreread">Mais Lidos</option>
        </select>
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
                <input type="search" name="busca_post" id="show_post_top[]" placeholder="Buscar Artigos...">
                <span class="dashicons dashicons-search"></span>
            </div>
            <div class="request_post">
                <option value="um">Um</option>
                <option value="dois">Dois</option>
                <option value="tres">Três</option>
                <option value="quatro">Quatro</option>
                <option value="cinco">Cinco</option>
                <option value="seis">Seis</option>
                <option value="sete">Sete</option>
                <option value="oito">Oito</option>
                <option value="nove">Nove</option>
                <option value="zero">zero</option>
            </div>
        </div>
        <script>
            const opts = document.querySelectorAll('.request_post option');
            const bts_delet = document.getElementsByClassName('delet_item');

            

            opts.forEach((item) => {
                item.addEventListener('click', function(){
                    console.log(this.value);

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
            });
            
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

?>