<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config\Email;
use Firebase\JWT\JWT;

require_once APPPATH . 'ThirdParty/PHPMailer/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/SMTP.php';

function enviarEmailRecuperacaoSenhaArmario($email, $nomeUsuario, $token)
{
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
    $mail->setFrom('noreply@gremiotimoteo.online', 'Grêmio Recuperação');
    $mail->addAddress($email, $nomeUsuario);

    

    // Configuração do conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Conta - Sistema de Registro de Armários';
    $mail->Body = 'Olá '.$nomeUsuario.'!<br><br>';
    $mail->Body .= 'Clique no link e altere a sua senha: <a href="api.gremiotimoteo.online/public/recuperacaoSenha?token='.$token.'&&sistema=1">recuperar.gremiotimoteo.online</a><br>';
    $mail->Body .= '<b>Não compartilhe este link com ninguém</b>';

    if (!$mail->send()) {
      return false;
    } else {
      return true;
    }
  } catch (Exception $e) {
    return "Erro ao enviar e-mail: {$e}";
  }
}
function gerarTokenRecuperacao($idUsuario)
  {
    $key = getenv('JWT_SECRET_ESQ_SENHA');
    $payload = [
      "iss" => "api-esqueci-senha",
      "aud" => "users", 
      "iat" => time(),
      "exp" => time() + 900, 
      "data" => [
        "id" => $idUsuario
      ]
    ];

    $token = JWT::encode($payload, $key, 'HS256');

    return $token;
  }