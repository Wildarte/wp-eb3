<?php get_header(); ?>
<style>
    .body_page{
        margin: 40px auto;
        padding: 10px;
    }
    .body_page h1{
        font-size: 3em;
        font-weight: 500;
        text-align: center;
        margin: 40px 10px;
    }
    .body_page h1::after{
        content: "";
        display: block;
        margin: 10px auto;
        width: 80px;
        height: 2px;
        border: none;
        background-color: #343434;
    }
    @media(max-width: 768px){
        .body_page h1{
            font-size: 1.6em;
            font-weight: 500;
            text-align: center;
            margin: 40px 10px;
        }
    }
</style>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <main>

        <section class="container body_page">

            <h1 class="title"><?php the_title(); ?></h1>

            <?php the_content(); ?>

        </section>

    </main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>