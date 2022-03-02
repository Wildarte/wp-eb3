<?php get_header() ?>

<?php wpb_set_post_views(get_the_ID()); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<main>
    <header class="container header_post">
        <h2 class="title_post"><?= get_the_title() ?></h2>
        <div class="autor_date_post">
            <h4 class="author_post"><?= get_the_author(); ?></h4>
            <time>
            <?= the_date('d \d\e F \d\e Y') ?>
            </time>
        </div>
    </header>

    <article class="body_post container">
    <?php 
        $thumb_single_post_header = get_the_post_thumbnail_url(null, 'normal');
        $thumb_single_post_header == "" ? $thumb_single_post_header = get_template_directory_uri().'/assets/img/default-image.png' : "";
    ?>
        <img class="image_post" src="<?= $thumb_single_post_header ?>" alt="">
        <style>
            .text_post{
                margin-bottom: 40px;
            }
            .content_post .text_post p{
                font-size: 1.2em;
                font-weight: 300;
                line-height: 1.5em;
                margin: 12px 0;
            }
            .content_post .text_post h1{
                font-size: 2.8em;
            }
            .content_post .text_post h2{
                font-size: 2.5em;
            }
            .content_post .text_post h3{
                font-size: 2.2em;
            }
            .content_post .text_post h4{
                font-size: 2em;
            }
            .content_post .text_post h5{
                font-size: 1.8em;
            }
            .content_post .text_post h6{
                font-size: 1.5em;
            }
            .content_post .text_post h1, .content_post .text_post h2, .content_post .text_post h3, .content_post .text_post h4,
            .content_post .text_post h5, .content_post .text_post h6{
                line-height: 2em;
            }
            .content_post .text_post ul,.content_post .text_post ol{
                margin: 20px 0 20px 40px;
            }
            .content_post .text_post ul{
                list-style: disc;
            }
            .content_post .text_post ul li,.content_post .text_post ol li{
                width: 100%;
                line-height: 1.8em;
                font-size: 1.2em;
                font-weight: 300;
            }
            .content_post .text_post img{
                width: 100%;
            }
            @media(max-width: 768px){
                .content_post .text_post p{
                    font-size: 1em;
                }
                .content_post .text_post ul li, .content_post .text_post ol li{
                    font-size: 1em;
                }
                .content_post .text_post h1, .content_post .text_post h2, .content_post .text_post h3, .content_post .text_post h4, .content_post .text_post h5, .content_post .text_post h6{
                    line-height: 1.4em;
                }
                .content_post .text_post h1{
                font-size: 2.3em;
                }
                .content_post .text_post h2{
                    font-size: 2em;
                }
                .content_post .text_post h3{
                    font-size: 1.8em;
                }
                .content_post .text_post h4{
                    font-size: 1.6em;
                }
                .content_post .text_post h5{
                    font-size: 1.4em;
                }
                .content_post .text_post h6{
                    font-size: 1em;
                }
            }
            @media(max-width: 420px){
                .content_post .text_post p{
                    font-size: .9em;
                }
            }
        </style>
        <div class="content_post">

            <div class="shares_posts">
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="bi bi-facebook"></a></i></li>
                    <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?= get_the_title() ?>&summary=<?= get_the_excerpt() ?>&source="><i class="bi bi-linkedin"></a></i></li>
                    <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"><i class="bi bi-twitter"></a></i></li>
                </ul>
            </div>

            <div class="text_post">
            <?= the_content() ?>
            
            </div>

            
        </div>

        

    </article>
    <?php include('inc/newsLetter.php') ?>

    <section class="posts_relation container">
        <?php

                $cat_post = get_the_category()[0]->slug;

                $args_cat_post = [
                    'post_type' => 'post',
                    'category_name' => $cat_post,
                    'category__not_in' => [''.get_the_category()[0]->term_id.'']
                ];

                $results_cat_post = new WP_Query($args_cat_post);
                
                
                if($results_cat_post->have_posts()): 
                
        ?>
        <header class="header_posts_relacionados">
            <h3>Posts Relacionados</h3>
            
        </header>
        <section class="body_posts_relacionados">

            <?php while($results_cat_post->have_posts()): $results_cat_post->the_post(); ?>
            <article class="card_post_relacionado">
                <?php 
                    $thumb_relat_post = get_the_post_thumbnail_url(null, 'normal');
                    $thumb_relat_post == "" ? $thumb_relat_post = get_template_directory_uri().'/assets/img/default-image.png' : "";
                ?>
                <img class="thumb_post_relacionado" src="<?= $thumb_relat_post; ?>" alt="">
                <h4><?= get_the_title() ?></h4>
                <div class="author_posts_relacionado">
                    <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                    <img class="photo_user_post_relacionado" src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" alt="">
                    <?= get_the_author(); ?>
                </div>
                <a class="link_post_relacionado" href="<?= the_permalink() ?>"></a>
            </article>

            <?php endwhile; ?>

            
        </section>
        <?php endif; wp_reset_query(); wp_reset_postdata(); ?>
    </section>
    <style>
        .comments{
            margin-bottom: 40px;
            border-top: 1px solid var(--cor-main);
            padding: 20px 10px;
        }
        .comments textarea{
            width: 100%;
            border: 1px solid var(--cor-main);
            margin: 5px 0;
            padding: 5px;
        }
        .comments p{
            font-weight: 300;
        }
        .comments h3.comment-reply-title{
            font-size: 2em;
            font-weight: 300;
        }
        .comments form input{
            width: 50%;
            margin: 5px 0;
            padding: 5px;
            border: 1px solid var(--cor-main);
        }
        .comments form p{
            display: flex;
            flex-wrap: wrap;
        }
        .comments form p.comment-form-author label{
            width: 100%!important;
        }
        .comments form p.comment-form-email label{
            width: 100%;
        }
        .comments form p.comment-form-url{
            display: none;
        }
        .comments #wp-comment-cookies-consent{
            width: 5%;
        }
        .comments form .form-submit input[type="submit"]{
            width: 280px;
            display: block;
            color: #fff;
            background-color: var(--cor-main);
            padding: 8px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            transition: .1s;
            border: none;
            margin: 20px 0;
        }
        .comments form .form-submit input[type="submit"]:hover{
            cursor: pointer;
        }

        .comments ol.commentlist{
            list-style: none;
        }
        .comments ol.commentlist li ul li{
            margin-left: 40px;
        }
        .comments .commentlist li p{
            margin: 10px 0;
        }
        .comments .commentlist li p::before{
            content: '"';
        }
        .comments .commentlist li p::after{
            content: '"';
        }
        .comments .commentlist img.avatar.avatar-32.photo{
            border-radius: 50%;
        }
        .comments .commentlist .reply a{
            width: 200px;
            display: block;
            color: #fff;
            background-color: var(--cor-main);
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: .9em;
            transition: .1s;
            border: none;
            margin: 20px 0;
        }
        .comments ol.commentlist .comment-meta.commentmetadata a{
            color: var(--cor-main);
            text-decoration: none;
        }
        .comments .comment-form-comment{
            margin-top: 40px;
        }

        .comment-respond a{
            color: var(--cor-main);
        }
        .comments .commentlist .comment-awaiting-moderation{
            color: red;
        }
        @media(max-width: 768px){
            .comments form input{
                width: 100%;
            }
            .comments form .form-submit input[type="submit"]{
                width: 100%;
            }
        }
    </style>

    <section class="comments container">
        <?php

            comments_template("", true);

        ?>
        <script>
            const textarea = document.querySelector(".comments textarea");
            textarea.setAttribute('rows', 4)
        </script>
    </section>

    
</main>
<?php endwhile; endif; ?>
<?php get_footer() ?>