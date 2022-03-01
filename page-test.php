<?php get_header(); //Template Name: página de posts ?>

<?php

if(!is_paged()): echo "É página de paginação";

echo "<hr>";

$args_last_post = [
    'post_type' => 'post',
];
$result_last_post = new WP_Query($args_last_post);

if($result_last_post->have_posts()): while($result_last_post->have_posts()): $result_last_post->the_post();

the_title();

endwhile; endif;

echo "<hr>";

echo "<hr>";

$args_last_post = [
    'post_type' => 'post',
];
$result_last_post = new WP_Query($args_last_post);

if($result_last_post->have_posts()): while($result_last_post->have_posts()): $result_last_post->the_post();

the_title();

endwhile; endif;

echo "<hr>";

endif;

if(have_posts()): while(have_posts()): the_post();

?>
    <main>

        <?php the_title(); ?>

    </main>

<?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>
<h2>diaiai</h2>
<?php previous_posts_link('Voltar'); ?>
<?php next_posts_link('Mais'); ?>

<?php get_footer(); ?>