<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'mail_info.php'; // Contient les informations SMTP

function envoyerEmail($email, $objet, $message) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $GLOBALS['Host'];
        $mail->SMTPAuth = $GLOBALS['SMTPAuth'];
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Username = $GLOBALS['Username'];
        $mail->Password = $GLOBALS['Password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $GLOBALS['Port'];

        $mail->setFrom($GLOBALS['Username'], $GLOBALS['nom_du_site']);
        $mail->addReplyTo($GLOBALS['send_email'], $GLOBALS['nom_du_site']);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $objet;
        $mail->Body = $message;
        $mail->CharSet = 'utf-8';

        if ($mail->send()) {
            return true; // Succès
        } else {
            return false; // Échec
        }
    } catch (Exception $e) {
        echo  $e;
        return false; // Erreur d'envoi
    }
}

?>