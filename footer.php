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
                <form action="" method="post">
                    <input type="text" name="" id="" placeholder="E-mail...">
                    <button class="footer_btn_submit">Enviar</button>
                </form>
            </div>
        </div>
        <div class="footer_info container-full">
            <div class="container footer_content_info">
                <p class="footer_logo">
                    <a class="footer_link_logo" href="#">
                        <img src="./assets/img/logo.png" alt="">
                    </a>
                </p>
                <p class="footer_link_politicas">
                    <a href="#">Legal</a>
                    <a href="#">Política de Privacidade</a>
                </p>
                <ul class="footer_social">
                    <li>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </footer>

    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/script.js"></script>
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
    </script>
</body>
</html>