<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <main>

        <?php the_title(); ?>

        <?php the_content(); ?>

    </main>

<?php endwhile; endif; get_footer(); ?>