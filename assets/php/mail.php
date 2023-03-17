<?php
include '../assets/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'sforms.inotify@sformscdsp.online';
$mail->Password = 'Eleven.11';

$mail->setFrom('sforms.inotify@sformscdsp.online', 'CDSP Notification');
