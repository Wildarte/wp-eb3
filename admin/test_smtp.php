<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == 'POST'):

$host = $_REQUEST['host'];
$username = $_REQUEST['username'];
$password = $_REQUEST['pass'];
$port = $_REQUEST['porta'];


require '../vendor/autoload.php';

//================================ test connection with server SMTP ================================
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Create a new SMTP instance
$smtp = new SMTP();
//Enable connection-level debug output

try {
    
    //Connect to an SMTP server
    if (!$smtp->connect('ssl://'.$host, $port)) {
        throw new Exception('Connect failed');
        
    }
    //Say hello
    if (!$smtp->hello(gethostname())) {
        throw new Exception('EHLO failed: ' . $smtp->getError()['error']);
       
    }
    //Get the list of ESMTP services the server offers
    $e = $smtp->getServerExtList();
    //If server can do TLS encryption, use it
    if (is_array($e) && array_key_exists('STARTTLS', $e)) {
        $tlsok = $smtp->startTLS();
        
        if (!$tlsok) {
            throw new Exception('Failed to start encryption: ' . $smtp->getError()['error']);
        }
        //Repeat EHLO after STARTTLS
        if (!$smtp->hello(gethostname())) {
            throw new Exception('EHLO (2) failed: ' . $smtp->getError()['error']);
        }
        //Get new capabilities list, which will usually now include AUTH if it didn't before
        $e = $smtp->getServerExtList();
    }
    //If server supports authentication, do it (even if no encryption)
    if (is_array($e) && array_key_exists('AUTH', $e)) {
        if ($smtp->authenticate($username, $password)) {
            echo '<span style="color: green">SMTP: Conexão ok!</span>';
        } else {
            throw new Exception('Authentication failed: ' . $smtp->getError()['error']);
            echo '<span style="color: red">SMTP: Erro ao conectar</span>';
        }
    }
} catch (Exception $e) {
    echo '<span style="color: orange"> SMTP error: ' . $e->getMessage(), "\n </span>";

}
//Whatever happened, close the connection.
$smtp->quit();
//================================ test connection with server SMTP ================================

else:
    echo "<script> window.location.href = '404'; </script>";
endif;

?>