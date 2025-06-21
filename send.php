<?php
// Файлы phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/phpmailer/Exception.php';
require '/phpmailer/PHPMailer.php';
require '/phpmailer/SMTP.php';





$email = $_POST['email'];

// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2><br>
Почта: $email<br>";

// Настройки PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                         //Send using SMTP
    $mail->Host       = 'smtp-pulse.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mikhail.pavlov@pvls.tech';                     //SMTP username
    $mail->Password   = 'jF9AsTPpZMfRq  ';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
// Переменные, которые отправляет пользователь

     $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('kulenko.jhenia@gmail.com', 'Jhenia User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

// Отправка сообщения
  $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Encoding = 'base64';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   $mail->msgHTML(file_get_contents('contents.html'), __DIR__);   

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);