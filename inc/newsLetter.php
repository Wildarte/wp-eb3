<section class="section_subscribe container-full">
    <div class="content_subscribe container">
        <div class="subscribe_left">
            <h3><?= get_option('show_title_newsletter') ?></h3>
            <p><?= get_option('show_subtitle_newsletter') ?></p>
        </div>
        <div class="subscribe_right">
            <form action="" method="post" class="form_news_letter" id="section_form">
                <input type="hidden" name="nulo_cut" id="nulo_cut" class="nulo_cut">
                <input type="hidden" name="nulo_campo" id="nulo_campo" class="nulo_campo">
                <input type="email" name="emailForm" id="emailForm" class="emailForm" placeholder="E-mail">
                <span style="width: 100%; text-align: left" id="retorno_form"></span>
                <button class="btn_news_letter" id="btn_news_letter">Enviar</button>
            </form>
        </div>
    </div>
</section>