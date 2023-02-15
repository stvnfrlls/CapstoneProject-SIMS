<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'officeregistrar@siscdsp.online';
$mail->Password = 'Frilles03?';

$mail->setFrom('officeregistrar@siscdsp.online', 'testmail');
