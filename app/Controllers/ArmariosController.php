<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArmarioModel;
use App\Models\UsuarioArmarioModel;

class ArmariosController extends ResourceController
{

  private $usuarioModel;
  private $armariosModel;

  public function __construct()
  {
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
  public function transferirArmario()
  {
    $input = $this->request->getRawInput();

    if (!isset($input['destinatario']) || !isset($input['armario'])) {
      return $this->fail('E-mail do destinatário e ID do armário são obrigatórios.', 400);
    }

    $model = new UsuarioArmarioModel();

    if ($model->transferirArmario($input['destinatario'], $input['armario'])) {
      return $this->respond(['message' => 'Transferência realizada com sucesso.']);
    }

    return $this->fail('Erro ao transferir armário. Destinatário não encontrado.', 400);
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

  public function cadastroUsuario()
  {
    $input = $this->request->getPost();

    if (!$input) {
      return $this->fail('Dados inválidos.', 400);
    }

    if ($this->usuarioModel->insertUsuario($input)) {
      return $this->respondCreated(['message' => 'Usuário cadastrado com sucesso!']);
    }

    return $this->fail('Erro ao cadastrar usuário.', 500);
  }
  public function alterarSenha()
  {
    $input = $this->request->getRawInput();

    if (!isset($input['id']) || !isset($input['novaSenha'])) {
      return $this->fail('ID e nova senha são obrigatórios.', 400);
    }

    if ($this->usuarioModel->updateUsuario($input['id'], ['senha' => $input['novaSenha']])) {
      return $this->respond(['message' => 'Senha alterada com sucesso.']);
    }

    return $this->fail('Erro ao alterar senha.', 500);
  }

  public function solicitarAlteracaoSenha()
  {
    return $this->respond(['message' => 'E-mail de recuperação de senha enviado!'], 200);
  }

  public function alterarDados()
  {
    $input = $this->request->getRawInput();

    if (!isset($input['id'])) {
      return $this->fail('ID do usuário é obrigatório.', 400);
    }

    if ($this->usuarioModel->updateUsuario($input['id'], $input)) {
      return $this->respond(['message' => 'Dados alterados com sucesso.']);
    }

    return $this->fail('Erro ao alterar dados.', 500);
  }


}
