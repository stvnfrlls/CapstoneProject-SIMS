<?php
include __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'sforms_notify@sformscdsp.online';
$mail->Password = 'Eleven.11';

$mail->setFrom('sforms_notify@sformscdsp.online', 'CDSP Notification');
