<?php

namespace App\Controllers;

use App\Models\UsuarioGerenciamentoModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use App\Models\UsuarioArmarioModel;

class AuthController extends ResourceController
{

  private $usuarioArmario;
  private $usuarioGerenciamento;

  public function __construct()
  {
    $this->usuarioArmario = new UsuarioArmarioModel();
    $this->usuarioGerenciamento = new UsuarioGerenciamentoModel();
  }

  public function authUsuarioArmario()
  {
    $request = \Config\Services::request(); // Obtenha a instância do request

    $json_data = $request->getBody(); // Obtém o corpo da requisição (JSON)
    $input = json_decode($json_data, true);

    if (!isset($input['usuario']) || !isset($input['senha'])) {
      return $this->fail('Usuário e senha não enviados para autenticação!', 400);
    }

    $usuario = urldecode($input['usuario']);
    $resultado = $this->usuarioArmario->autenticar($usuario, $input['senha']);


    if ($resultado === "erro") {
      return $this->respond(['message' => "Usuário ou senha incorreto / Usuário não encontrado"], 400);
    } else {
      $token = $this->gerarToken($resultado['idUsuario']);
      return $this->respond(['message' => 'Login autorizado!', 'token' => $token, 200]);
    }
  }

  public function authUsuarioGerenciamento()
  {
    $request = \Config\Services::request(); // Obtenha a instância do request

    $json_data = $request->getBody(); // Obtém o corpo da requisição (JSON)
    $input = json_decode($json_data, true);

    if (!isset($input['usuario']) || !isset($input['senha'])) {
      return $this->fail('Usuário e senha não enviados para autenticação!', 400);
    }

    $usuario = urldecode($input['usuario']);
    $resultado = $this->usuarioGerenciamento->autenticar($usuario, $input['senha']);


    if ($resultado === "erro") {
      return $this->respond(['message' => "Usuário ou senha incorreto / Usuário não encontrado"], 400);
    } else {
      $token = $this->gerarToken($resultado['codigo']);
      return $this->respond(['message' => 'Login autorizado!', 'token' => $token, 200]);
    }
  }
  public function gerarToken($idUsuario)
  {
    $key = getenv('JWT_SECRET');
    $payload = [
      "iss" => "api-login", // Issuer
      "aud" => "users", // Audience
      "iat" => time(), // Issued at
      "exp" => time() + 3600, // Expiration time (1 hour)
      "data" => [
        "id" => $idUsuario
      ]
    ];

    $token = JWT::encode($payload, $key, 'HS256');

    return $token;
  }

}
