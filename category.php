<?php get_header(); ?>

<?php

$categoria = get_category(get_query_var('cat'))->name;

$args_category_page = [
    'post_type' => 'post',
    'category_name' => $categoria
];

$result_category_page = new WP_Query($args_category_page);

?>
<style>
    .header_search{
        padding: 10px;
        margin: 60px auto 20px;
    }
    .header_search h2{
        font-size: 2em;
        font-weight: 300;
        padding: 0 15px 15px 15px;
    }
    .header_search h4{
        padding: 15px 15px 0 15px;
        font-weight: 300;
    }
    .no_result{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .no_result img{
        margin: 80px auto 40px;
    }
    .no_result h3{
        width: 100%;
        text-align: center;
        font-size: 2em;
        margin: 0 auto 100px;
    }
    @media(max-width: 768px){
        .header_search h2{
            font-size: 1.6em;
            padding: 0;
        }
    }
</style>
    <main>

        <header class="container header_search">
            <h4>Categoria:</h4>
            <h2><?= $categoria; ?></h2>
        </header>

        <section class="container" style="display: flex; flex-wrap: wrap; padding: 10px">
            <?php if($result_category_page->have_posts()): while($result_category_page->have_posts()): $result_category_page->the_post(); ?>
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
                <?php endwhile; else: ?>

                <div class="no_result">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/no_result.png" >
                    <h3>Nada encontrado</h3>
                </div>
                <?php endif; wp_reset_query(); wp_reset_postdata(); ?>
        </section>

        <div class="controll_posts">
                        <?php previous_posts_link('Voltar'); ?>
                        <?php next_posts_link('Mais'); ?>
                    </div>

    </main>



<?php get_footer(); ?>