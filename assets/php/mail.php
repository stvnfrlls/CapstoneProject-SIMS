<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

global $mail;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'tls';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'admin@siscdsp.online';
$mail->Password = 'Eleven.11';

$mail->setFrom('admin@siscdsp.online', 'CDSP Admin Office');
