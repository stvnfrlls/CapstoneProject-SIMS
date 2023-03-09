<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '..\PHPMailer\src\Exception.php';
require_once '..\PHPMailer\src\PHPMailer.php';
require_once  '..\PHPMailer\src\SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->isHTML(true);

$mail->Username = 'testmail@siscdsp.online';
$mail->Password = 'Eleven.11';

$mail->setFrom('testmail@siscdsp.online', 'testmail');
