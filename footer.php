    <footer class="footer container-full">
        <div class="footer_main container">
            <div class="footer_left">
                <h3>
                Quer receber mais conteúdos brilhantes como esse de graça?
                </h3>
                <h4>
                Inscreva-se para receber nossos conteúdos por email e participe da comunidade da Rock Content!
                </h4>
            </div>

            <div class="footer_right">
                <form action="" method="post" class="form_footer" id="form_footer">
                    <input type="hidden" name="nulo_cut" id="nulo_cut2">
                    <input type="hidden" name="nulo_campo" id="nulo_campo2">
                    <input type="email" name="emailForm2" id="emailForm2" placeholder="E-mail...">
                    <span style="display:block;width: 100%; text-align: left" id="retorno_form2"></span>
                    <button class="footer_btn_submit btn_news_letter" id="btn_news_letter2">Enviar</button>
                </form>
            </div>
        </div>
        <div class="footer_info container-full">
            <div class="container footer_content_info">
                <p class="footer_logo">
                    <a class="footer_link_logo" href="<?= get_home_url(); ?>">
                        <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        ?>
                        <img src="<?=  esc_url( $logo[0] ); ?>" alt="">
                    </a>
                </p>
                <p class="footer_link_politicas">
                    <?php
                        $link_politica = get_option('show_link_politica');
                        if(!empty($link_politica)):
                    ?>
                    <a href="<?= $link_politica; ?>">Política de Privacidade</a>
                    <?php endif; ?>
                </p>
                <ul class="footer_social">
                    <?php
                        $facebook = get_option('show_facebook');
                        $instagram  = get_option('show_instagram');
                        $twitter = get_option('show_twitter');
                        $linkedin = get_option('show_linkedin');
                        $whatsapp = get_option('show_whatsapp');
                        $tiktok = get_option('show_tiktok');

                        if(!empty($facebook)):
                    ?>
                    <li>
                        <a href="<?= $facebook; ?>"><i class="bi bi-facebook"></i></a>
                    </li>
                    <?php endif; if(!empty($instagram)): ?>
                    <li>
                        <a href="<?= $instagram; ?>"><i class="bi bi-instagram"></i></a>
                    </li>
                    <?php endif; if(!empty($twitter)): ?>
                    <li>
                        <a href="<?= $twitter; ?>"><i class="bi bi-twitter"></i></a>
                    </li>
                    <?php endif; if(!empty($linkedin)): ?>
                    <li>
                        <a href="<?= $linkedin; ?>"><i class="bi bi-linkedin"></i></a>
                    </li>
                    <?php endif; if(!empty($whatsapp)): ?>
                    <li>
                        <a href="<?= $whatsapp; ?>"><i class="bi bi-whatsapp"></i></a>
                    </li>
                    <?php endif; if(!empty($tiktok)): ?>
                    <li>
                        <a href="<?= $tiktok; ?>"><i class="bi bi-tiktok"></i></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </footer>
    <!-- 
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/script.js"></script>
     -->
    
    <!-- wp footer -->
    <?php wp_footer(); ?>
    <!-- wp footer -->
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true,
                        margin: 20,
                        loop: true
                    }
                }
            });
        });
        const bf = document.getElementById('btn_news_letter');
        const bf2 = document.getElementById('btn_news_letter2')
        bf.addEventListener('click', (e) => {
            e.preventDefault();
            sendForm('<?= get_template_directory_uri() ?>/submit_form.php');
        });
        bf2.addEventListener('click', (e) => {
            e.preventDefault();
            sendForm2('<?= get_template_directory_uri() ?>/submit_form.php');
        });
        
    </script>
</body>
</html>