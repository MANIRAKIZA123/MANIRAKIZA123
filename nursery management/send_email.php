<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendResetEmail($email, $token) {
    $mail = new PHPMailer(true);
    try {
        $mail->setFrom('your-email@example.com', 'Nursery Management');
        $mail->addAddress($email);
        $mail->Subject = "Password Reset Request";
        $mail->Body = "Click here to reset your password: http://yourwebsite.com/reset_password.php?token=$token";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent.";
    }
}
?>
