<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function reset_code_mail($mail_client, $code_reset) {



$mail = new PHPMailer(true);

// On va utiliser le SMTP
$mail->isSMTP();

// On configure l'adresse du serveur SMTP
$mail->Host       = 'localhost';    

// On désactive l'authentification SMTP
$mail->SMTPAuth   = false;    

// On configure le port SMTP (MailHog)
$mail->Port       = 1025;                                   

// Expéditeur du mail - adresse mail + nom (facultatif)
$mail->setFrom('noreply@thedistrict.com', 'The District Company');

// Destinataire(s) - adresse et nom (facultatif)
$mail->addAddress($mail_client, " ");


//Adresse de reply (facultatif)
$mail->addReplyTo("reply@thedistrict.com", "Reply");

//CC & BCC
// $mail->addCC("cc@example.com");
// $mail->addBCC("bcc@example.com");

// On précise si l'on veut envoyer un email sous format HTML 
$mail->isHTML(true);


// Sujet du mail
$mail->Subject = '=?UTF-8?B?' . base64_encode('The District : Code de réinitialisation') . '?=';

// Corps du message
$mail->Body = "Voici votre code de Code de réinitialisation : " . $code_reset;

// On envoie le mail dans un block try/catch pour capturer les éventuelles erreurs
if ($mail){
    try {
        $mail->send();
        echo 'Email envoyé avec succès';
        echo ' <meta http-equiv="refresh" content="0;url=mail_success.php">';
        } catch (Exception $e) {
        echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
        }
    }

}