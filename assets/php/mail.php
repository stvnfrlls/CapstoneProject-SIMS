<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '../../PHPMailer/src/Exception.php';
require_once __DIR__ . '../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '../../PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'notify@sformscdsp.online';
$mail->Password = 'Eleven.11';

$mail->setFrom('notify@sformscdsp.online', 'CDSP Notification');
