<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$website = htmlspecialchars($_POST['website']);
$message = htmlspecialchars($_POST['message']);

if (!empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $receiver = "halil14saral@gmail.com"; // Enter the email address where you want to receive all messages

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com'; // Change this to your email service's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'deneme@outlook.com'; // Change this to your email address
            $mail->Password = '*********'; // Change this to your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($receiver);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "From: $name <$email>";
            $mail->Body = "Name: $name<br>Email: $email<br>Phone: $phone<br>Website: $website<br><br>Message:<br>$message<br><br>Regards,<br>$name";

            $mail->send();
            echo "Your message has been sent";
        } catch (Exception $e) {
            echo "Sorry, failed to send your message!";
        }
    } else {
        echo "Enter a valid email address!";
    }
} else {
    echo "Email and message field is required!";
}
?>
