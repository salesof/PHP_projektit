<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
//require 'authController.php'; // Tietokantayhteys
//require 'vendor/autoload.php'; // Adjust the path as needed if you're not using Composer

function sendVerificationEmail($email, $token)
{
    $mail = new PHPMailer(true);

    // Sisällytä SMTP-asetukset
    require 'smtp_config.php';

    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = $smtpAuth;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port = $smtpPort;

        // Recipients
        $mail->setFrom('asiakaspalvelu@neilikka.fi', 'Puutarhaliike Neilikka');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Vahvista sähköpostiosoitteesi';
        $mail->Body    = "
            <h1>Vahvista sähköpostiosoitteesi Puutarhaliike Neilikan palveluun</h1>
            <p>Siirry alla olevaan osoitteeseen viimeistelläksesi tunnuksen luonnin:</p>
            <a href='http://localhost/neilikka/controllers/verify.php?token=$token'>Vahvista sähköpostiosoitteesi</a>
        ";

        if (!$mail->send()) {
            echo 'Viestiä ei voitu lähettää.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Viesti lähetettiin';
        }
    } catch (Exception $e) {
        echo "Viestiä ei voitu lähettää. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendResetEmail($email, $token)
{
    $mail = new PHPMailer(true);

    // Sisällytä SMTP-asetukset
    require 'smtp_config.php';

    try {
        // Mailtrap SMTP asetukset
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = $smtpAuth;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port = $smtpPort;

        // Vastaanottaja
        $mail->setFrom('asiakaspalvelu@neilikka.fi', 'Puutarhaliike Neilikka');
        $mail->addAddress($email);

        // Viestin sisältö
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Salasanan palautuspyyntö';
        $mail->Body = "
            <h1>Palauta salasanasi</h1>
            <p>Klikkaa alla olevaa linkkiä vaihtaaksesi salasanasi:</p>
            <a href='http://localhost/neilikka/resetpassword.php?token=$token'>Vaihda salasana</a>
            <p>Linkki on voimassa yhden tunnin.</p>
        ";

        // Lähetä sähköposti
        $mail->send();
    } catch (Exception $e) {
        echo "Viestiä ei voitu lähettää. Mailer Error: {$mail->ErrorInfo}";
    }
}
