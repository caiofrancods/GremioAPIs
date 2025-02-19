<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config\Email;

require_once APPPATH . 'ThirdParty/PHPMailer/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/SMTP.php';

function enviarEmail($email, $codDoc, $nomeUsuario, $nomeDoc)
{
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  try {
    $mail = new PHPMailer(true);

    $emailConfig = new Email();

    $mail->isSMTP();

    $mail->Host = $emailConfig->SMTPHost;
    $mail->SMTPAuth = true;
    $mail->Username = $emailConfig->SMTPUser;
    $mail->Password = getenv('email_pass');
    $mail->SMTPSecure = $emailConfig->SMTPCrypto;
    ;
    $mail->Port = $emailConfig->SMTPPort;
    $mail->CharSet = 'UTF-8';

    // Configuração do remetente e destinatário
    $mail->setFrom('noreply@gremiotimoteo.online', 'Grêmio Assinaturas');
    $mail->addAddress($email, $nomeUsuario);

    // Configuração do conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = "[Grêmio Assinaturas] Documento disponível para assinatura";
    $mail->Body = "Olá $nomeUsuario!<br><br>";
    $mail->Body .= "O documento <strong>$nomeDoc</strong> aguarda a sua assinatura!<br>";
    $mail->Body .= "Acesse pelo link: <a href='https://assinatura.gremiotimoteo.online/login.php?codigo=$codDoc'>Clique aqui para assinar</a>";

    if (!$mail->send()) {
      return false;
    } else {
      return true;
    }
  } catch (Exception $e) {
    return "Erro ao enviar e-mail: {$e}";
  }
}
