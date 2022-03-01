<?php get_header(); ?>

    <main>
        <?php
            $posts = get_option('show_post_top');
            $length = count($posts);

            echo "<h3>".$length ."</h3>";

            for($i = 0; $i < $length; $i++){
                $args = [
                    'post_type' => 'post',
                    'title' => $posts[$i]
                ];
                $resp = new WP_Query($args);

                if($resp->have_posts()): $resp->the_post();
                the_title();
                //echo get_post(get_the_ID())->post_name;
                echo "<br>";
                endif;
            }

            
            $imgs = get_option('show_ads_images');

            $total = count($imgs);

            for($item = 0; $item < $total; $item++){
                echo '<h1>';
                for($subitem = 0; $subitem < $total; $subitem++){

                    echo $imgs[$item][$subitem] . ' ';

                }
                echo '</h1>';
            }
            

        ?>

        <section class="section_intro_home">
            <div class="home_content container">
                <div class="home_intro_left">
                    <h1 class="home_intro_title"><?= get_option('show_title_home') ?></h1>
                   
                    <h2 class="home_intro_subtitle"><?= get_option('show_subtitle_home') ?></h2>
                    <p class="home_intro_text"><?= get_option('show_description_home') ?></p>
                    <?php
                            $text_cta = get_option('show_text_cta');
                            $link_cta = get_option('show_link_cta');

                            if($text_cta):
                    ?>
                    <a class="home_intro_cta" href="<?= get_option('show_link_cta') ?>"><?= get_option('show_text_cta') ?></a>
                    <?php endif; ?>
                </div>

                <div class="home_intro_right">
                    <img src="<?php echo wp_get_attachment_url( get_option( 'show_image_home' ) ); ?>" alt="">
                </div>
            </div>
        </section>

        <section class="section_posts container">
            <div class="post_top_home">
                <div class="owl-carousel owl-theme my-carousel" style="">

                    <?php
                            $posts = get_option('show_post_top');
                            $length = count($posts);
                
                            for($i = 0; $i < $length; $i++):
                                $args = [
                                    'post_type' => 'post',
                                    'title' => $posts[$i]
                                ];
                                $resp = new WP_Query($args);
                
                                if($resp->have_posts()): $resp->the_post();
                    ?>
                    <article class="card_post_top">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'medium');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/default-image.png' : "";
                        ?>
                        <img class="img_thump_post_top" src="<?= $thumb; ?>" alt="">
                        <div class="text_post_top">
                            <h2><?= get_the_title(); ?></h2>
                            <p><?= get_the_excerpt() ?></p>

                        </div>

                        <div class="card_post_top_author">
                            <div class="img_author">
                            <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" alt="thumbnail do autor">
                            </div>
                            <time>
                                <?= get_the_date("d/m/Y"); ?>
                            </time>
                        </div>
                        <a class="link_post" href="<?= get_the_permalink() ?>"></a>
                    </article>

                    <?php endif; wp_reset_query(); wp_reset_postdata(); endfor; ?>

                </div>
            </div>
            

            <section class="posts_pos_top">
                <?php

                    $posts_method = get_option('show_post_top_method');
                    $post_category = get_option('show_post_top_category');
                    
                    //echo "method: ".$posts_method."<br>";
                    //echo "categoria: ".$post_category."<br>";

                    switch($posts_method):
                        case "lastPost":
                            $args_down = [
                                'post_type' => 'post',
                                'posts_per_page' => 3
                            ];
                        break;
                        case "category":
                            $args_down = [
                                'post_type' => 'post',
                                'category_name' => $post_category,
                                'posts_per_page' => 3
                            ];
                        break;
                        case "noreread":
                            $args_down = [
                                'meta_key' => 'wpb_post_views_count',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'posts_per_page' => 3
                            ];
                        break;
                        default:
                            $args_down = [
                                'post_type' => 'post',
                                'posts_per_page' => 3
                            ];
                    endswitch;

                    $result_post = new WP_Query($args_down);

                    if($result_post->have_posts()):
                        while($result_post->have_posts()):
                            $result_post->the_post();

                ?>
                <article class="card_post_pos_top">
                        <?php 
                            $thumb_down = get_the_post_thumbnail_url(null, 'medium');
                            $thumb_down == "" ? $thumb_down = get_template_directory_uri().'/assets/img/default-image.png' : "";
                        ?>
                    <img class="thumb_post_top" src="<?= $thumb_down ?>" alt="">
                    <h2 class="card_title_pos_top"><?= get_the_title(); ?></h2>
                    <p class="card_resumo_post_pot"><?= get_the_excerpt() ?></p>
                    <div class="card_author_pos_top">
                        <div class="thumb_author_pos_top">
                            <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                            <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" alt="thumbnail autor">
                        </div>
                        <time>
                            <?= get_the_date("d/m/Y"); ?>
                        </time>
                    </div>
                    <a class="link_post" href="<?= get_the_permalink() ?>"></a>
                </article>
                <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>

                
            </section>
        </section>

        <?php include('inc/newsLetter.php') ?>

        <section class="section_last_posts container-full">
            <div class="content_last_posts container">
                <section class="left_last_posts">
                    <header class="header_last_posts">
                        <h3>Últimas Publicações</h3>
                    </header>
                    <?php

                        $args_last_post = [
                            'post_type' => 'post',
                        ];
                        $result_last_post = new WP_Query($args_last_post);

                        if($result_last_post->have_posts()): while($result_last_post->have_posts()): $result_last_post->the_post();
                        
                    ?>
                    <article class="card_last_post">
                        <?php 
                            $thumb_last_post = get_the_post_thumbnail_url(null, 'thumbnail');
                            $thumb_last_post == "" ? $thumb_last_post = get_template_directory_uri().'/assets/img/default-image.png' : "";
                        ?>
                        <img class="thumb_last_post" src="<?= $thumb_last_post; ?>" alt="">
                        <div class="card_last_post_text">
                            <h3><?= get_the_title() ?></h3>
                            <div class="data_last_post">
                                <div class="photo_author_last_post">
                                    <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" alt="">
                                </div>
                                <time>
                                    <?= get_the_date("d/m/Y"); ?>
                                </time>
                            </div>
                        </div>
                        <a class="link_post" href="#"></a>
                    </article>

                    <?php endwhile; endif; ?>

                    
                    <div class="btn_see_more_home">
                        <a href="#">Ver mais posts</a>
                    </div>
                </section>

                <section class="right_last_posts">
                    <!-- 
                    <h3>Escolha do Editor</h3>
                    <section class="body_right_last_post">
                        <article class="card_right_last_post">
                            <a href="#">
                                <h4>Remarketing e retargeting: qual a diferença e quando usar cada estratégia</h4>
                            </a>
                            <div class="author_right_post">
                                <div class="photo_author_right_post">
                                    <img src="./assets/img/user.png" alt="">
                                </div>
                                <span class="name_author_right_post">
                                    Redator Rock Content
                                </span>
                            </div>
                        </article>

                        <article class="card_right_last_post">
                            <a href="#">
                                <h4>Remarketing e retargeting: qual a diferença e quando usar cada estratégia</h4>
                            </a>
                            <div class="author_right_post">
                                <div class="photo_author_right_post">
                                    <img src="./assets/img/user.png" alt="">
                                </div>
                                <span class="name_author_right_post">
                                    Redator Rock Content
                                </span>
                            </div>
                        </article>
                    </section>
                    -->
                    <section class="img_ads">
                        <a href="#" class="card_img_ads">
                            <img src="<?= get_template_directory_uri() ?>/assets/img/ads1.webp" alt="">
                        </a>
                        <a href="#" class="card_img_ads">
                            <img src="<?= get_template_directory_uri() ?>/assets/img/ads2.webp" alt="">
                        </a>
                        <a href="#" class="card_img_ads">
                            <img src="<?= get_template_directory_uri() ?>/assets/img/ads3.webp" alt="">
                        </a>
                    </section>
                </section>
            </div>
        </section>

    </main>

<?php get_footer(); ?>