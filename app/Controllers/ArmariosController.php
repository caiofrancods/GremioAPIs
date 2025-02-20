<?php

namespace App\Controllers;

use App\Models\CursoModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ArmarioModel;
use App\Models\UsuarioArmarioModel;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
helper(filenames: 'EsqueciSenha_helper');

class ArmariosController extends ResourceController
{

  private $usuarioModel;
  private $armariosModel;

  private $cursoModel;

  public function __construct()
  {
    $this->usuarioModel = new UsuarioArmarioModel();
    $this->armariosModel = new ArmarioModel();
    $this->cursoModel = new CursoModel();
  }
  public function index()
  {
    $armarios = $this->armariosModel->getArmarios();
    return $this->respond(['message' => $armarios], 200);
  }
  public function transferirArmario()
  {
    $input = $this->request->getJSON(true);

    if (!isset($input['remetente']) || !isset($input['destinatario']) || !isset($input['armario'])) {
      return $this->fail('E-mail do remetente, do destinatário e ID do armário são dados obrigatórios.', 400);
    }

    $userId = json_decode($this->request->jwtUserId);
    $user = $this->usuarioModel->getUsuarioPorEmail($input['remetente']);
    if ($userId != $user['idUsuario']) {
      return $this->respond(['message' => 'O usuário não é proprietário desta unidade'], 401);
    }

    if ($this->armariosModel->transferirArmario($input['remetente'], $input['destinatario'], $input['armario'])) {
      return $this->respond(['message' => 'Transferência realizada com sucesso.']);
    }
    return $this->fail('Erro ao transferir armário', 400);
  }
  public function armariosPorUsuario($usuario)
  {
    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $usuario) {
      return $this->respond(['message' => 'O usuário não tem acesso a estes dados'], 401);
    }

    $armarios = $this->armariosModel->getArmarioDono($usuario);
    return $this->respond(['message' => $armarios], 200);
  }

  public function dadosUsuario($usuario)
  {
    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $usuario) {
      return $this->respond(['message' => 'O usuário não tem acesso a estes dados'], 401);
    }
    $user = $this->usuarioModel->getUsuarioPorId($usuario);
    return $this->respond(['message' => $user], 200);
  }

  public function cadastroUsuario()
  {
    $json_data = $this->request->getBody(); // Obtém o corpo da requisição (JSON)
    $input = json_decode($json_data, true);

    if (!$input) {
      return $this->fail('Dados inválidos.', 400);
    }

    if ($this->usuarioModel->insertUsuario($input)) {
      return $this->respondCreated(['message' => 'Usuário cadastrado com sucesso!'], 200);
    }

    return $this->fail('Erro ao cadastrar usuário.', 500);
  }

  public function solicitarAlteracaoSenha($email)
  {
    $user = $this->usuarioModel->getUsuarioPorEmail($email);
    if (!$user) {
      return $this->respond(['message' => 'Usuário não encontrado'], 400);
    }
    $token = gerarTokenRecuperacao($user['idUsuario']);
    $this->usuarioModel->setRecuperacao($user['idUsuario'], $token);
    if (enviarEmailRecuperacaoSenhaArmario($email, $user['nome'], $token)) {
      return $this->respond(['message' => 'E-mail de recuperação de senha enviado!'], 200);
    } else {
      return $this->respond(['message' => 'Erro ao enviar a recuperação de senha ao e-mail'], 400);
    }

  }
  public function alterarSenha()
  {
    $input = json_decode($this->request->getBody()); // Retorna um objeto

    // Acessando os atributos corretamente com "->"
    if (!isset($input->token) || !isset($input->novaSenha)) {
      return $this->fail('Token e nova senha são obrigatórios.', 400);
    }

    $token = $input->token;
    $senha = md5($input->novaSenha); // Criptografando a senha com MD5 (não é seguro, considere bcrypt)

    try {
      // Decodifica o token JWT
      $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET_ESQ_SENHA'), 'HS256'));

      // Obtém o token de recuperação salvo no banco
      $recuperacao = $this->usuarioModel->getRecuperacao($decoded->data->id);

      if ($recuperacao === $token) {
        // Atualiza a senha do usuário
        if ($this->usuarioModel->updateSenha($decoded->data->id, $senha)) {
          // Remove o token de recuperação após a alteração da senha
          $this->usuarioModel->setRecuperacao($decoded->data->id, "");
          return $this->respond(['message' => 'Senha alterada com sucesso.']);
        }
      }

      return $this->fail('Erro ao alterar senha.', 500);
    } catch (Exception $e) {
      return $this->fail('Token inválido ou expirado.', 401);
    }
  }


  public function alterarDados()
  {
    $input = json_decode($this->request->getBody(), true);

    if (!isset($input['idUsuario'])) {
      return $this->fail('ID do usuário é obrigatório.', 400);
    }

    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $input['idUsuario']) {
      return $this->respond(['message' => 'O usuário não pode alterar estes dados'], 401);
    }

    if ($this->usuarioModel->updateUsuario($input['idUsuario'], $input)) {
      return $this->respond(['message' => 'Dados alterados com sucesso.']);
    }

    return $this->fail('Erro ao alterar dados.', 500);
  }

  public function validacao($codigoArmario, $comprovante)
  {
    $arm = $this->armariosModel->validacao($codigoArmario, $comprovante);
    $dono = $this->usuarioModel->getUsuarioPorId($arm['dono']);
    $arm['nomeDono'] = $dono['nome'];
    $arm['cursoDono'] = $dono['idCurso'];
    if ($arm != null) {
      return $this->respond(['message' => $arm], 200);
    } else {
      return $this->respond(['message' => "Erro ao validar"], 400);
    }
  }

  public function listarCursos()
  {
    $cursos = $this->cursoModel->listarCursos();
    if ($cursos != null) {
      return $this->respond(['message' => $cursos], 200);
    } else {
      return $this->respond(['message' => "Erro ao listar"], 400);
    }
  }
}
