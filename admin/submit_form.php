<?php

//require '../../../wp-config.php';

$host = get_option("smtp_host");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'):

    if($_POST['null1'] != "" || $_POST['null2'] != ""):
        echo "5"; //caso preencham os camapos ocultos
    else:

        if(empty($_POST['nomeForm']) || empty($_POST['emailForm']) || empty($_POST['mensagemForm'])):
            echo "4"; //caso algum campo obrigatório esteja vazio
        else:

            $host = get_option("smtp_host");
            $username = get_option("smtp_username");
            $password = get_option("smtp_password");
            $port = get_option("smtp_port");
            $smtp_email = get_option("smtp_email");
            $smtp_secure = get_option("smtp_secure");
            $emailContato = get_option("email_empresa");

            $nome = $_POST['nomeForm'];
            $email = $_POST['emailForm'];
            $whatsapp = $_POST['whatsappForm'];
            $mensagem = $_POST['mensagemForm'];

            $url = 'dankicode.site';
            $toEmail = 'contato@digisolucao.com';
            $emailServer = 'formulario@'.$url;
            $assunto = "Mensagem do formulário";

            if(empty($host) || empty($username) || empty($password) ||empty($port)):
                
                //caso algum dos campos de configuração de servidor de email esteja vazio

                //Create a new PHPMailer instance
                $mail = new PHPMailer();
                
                $dominio = $_SERVER['SERVER_NAME'];

                $mail->CharSet = 'UTF-8';
                //Set who the message is to be sent from
                $mail->setFrom('from@'.$dominio, 'Mensagem de '.$nome.'');
                //Set who the message is to be sent to
                $mail->addReplyTo($email, $nome);
                //Set the subject line
                $mail->addAddress($emailContato);
                //Set an alternative reply-to address
                $mail->Subject = $assunto;
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body

                $mail->msgHTML("<html> <h3>Você recebeu uma mensagem do seu site</h3> <p><strong>Nome: </strong> {$nome} </p> <p> <strong>e-mail: </strong> {$email} </p> <p> <strong> Telefone: </strong> {$whatsapp}</p> <p><strong> Mensagem: </strong>{$mensagem}</p> </html>");

                //send the message, check for errors
                if (!$mail->send()) {
                    echo 'Mailer Error without SMTP: ' . $mail->ErrorInfo;
                } else {
                    echo "1";
                }

            else:

                $mail = new PHPMailer();

                 //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                if($smtp_secure == "ssl/tls"){                                            //Send using SMTP
                    $mail->Host = "ssl://".$host;                     //Set the SMTP server to send through
                }elseif($smtp_secure == "none"){
                    $mail->Host = $host;
                }else{
                    $mail->Host = $host;
                }
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $username;                     //SMTP username
                $mail->Password   = $password;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->CharSet = 'UTF-8';
                //Set who the message is to be sent from
                $mail->setFrom($smtp_email, 'Mensagem de '.$nome.'');
                //Set an alternative reply-to address
                $mail->addReplyTo($email, $nome);
                //Set who the message is to be sent to
                $mail->addAddress($emailContato);
                //Set the subject line
                $mail->Subject = $assunto;
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body

                $mail->msgHTML("<html> <h3>Mensagem recebida do formulário de contato</h3> <p><strong>Nome: </strong> {$nome} </p> <p> <strong>e-mail: </strong> {$email} </p> <p> <strong> WhatsApp: </strong> {$whatsapp}</p> <p><strong> Mensagem: </strong>{$mensagem}</p> </html>");

                if(!$mail->send()):
                    echo 'Mailer Error with SMTP: ' . $mail->ErrorInfo;
                else:
                    echo "1";
                endif;

            endif;
        
        endif;

    endif;

else:
    echo "<script> window.location.href = '404'; </script>";
endif;




?>