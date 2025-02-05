<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArmarioModel;
use App\Models\UsuarioArmarioModel;

class ArmariosController extends ResourceController
{

  private $usuarioModel;
  private $armariosModel;

  public function __construct() {
    $this->usuarioModel = new UsuarioArmarioModel();
    $this->armariosModel = new ArmarioModel();
  }
  public function index()
  {
    $db1 = \Config\Database::connect();
    $query1 = $db1->query("SELECT * FROM Armario");
    $result1 = $query1->getResult();
    return $this->respond(['message' => $result1], 200);
  }

  public function auth($usuario, $senha)
  {
    $resultado = $this->usuarioModel->autenticar($usuario, md5($senha));

    if ($resultado === "erro") {
      return $this->respond(['message' => "Usuário ou senha incorreto / Usuário não encontrado"], 200);
    } else {
      return $this->respond(['message' => $resultado->id], 200);
    }
  }

  public function transferencia()
  {
    $destinatario = $this->request->getGet('destinatario');
    $armario = $this->request->getGet('armario');
    $this->armariosModel->transferir($destinatario, $armario);
    return $this->respond(['message' => 'Auth'], 200);
  }

  public function armariosPorUsuario($usuario)
  {
    $armarios = $this->armariosModel->getArmarioDono($usuario);
    return $this->respond(['message' => $armarios], 200);
  }

  public function dadosUsuario($usuario)
  {
    $user = $this->usuarioModel->getUsuarioPorId($usuario);
    return $this->respond(['message' => $user], 200);
  }

  public function criarUsuario()
  {
    //$nome = $this->request->getPost('nome');

    return $this->respond(['message' => 'Auth'], 200);
  }
  public function trocaSenha()
  {
    //$input = $this->request->getRawInput();

    return $this->respond(['message' => 'Auth'], 200);
  }

  public function trocaDados()
  {
    // $input = $this->request->getRawInput();

    return $this->respond(['message' => 'Auth'], 200);
  }


}
