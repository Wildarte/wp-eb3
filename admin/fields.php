<?php

   function add_new_menu_itens(){

        add_menu_page(
            'Configuração do Tema',
            'Configuração do Tema',
            '',
            'theme-options',
            100
        );

        include('fieldsGeral.php');
        include('fieldsPost.php');
        include('fieldsContato.php');
        include('fieldsAds.php');
        include('fieldsFooter.php');
        include('fieldsSMTP.php');

   } 
   add_action('admin_menu',  'add_new_menu_itens');
   
?>