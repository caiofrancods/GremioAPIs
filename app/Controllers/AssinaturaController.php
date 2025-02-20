<?php

namespace App\Controllers;

use App\Models\DocumentoModel;
use App\Models\DocumentoUsuarioModel;
use App\Models\TipoModel;
use App\Models\UsuarioGerenciamentoModel;
use CodeIgniter\RESTful\ResourceController;
helper(filenames: 'Assinatura_helper');

class AssinaturaController extends ResourceController
{
  private $documentoModel;
  private $documentoUsuarioModel;
  private $usuarioGerenciamnto;

  private $tipoModel;

  public function __construct()
  {
    $this->documentoModel = new DocumentoModel();
    $this->documentoUsuarioModel = new DocumentoUsuarioModel();
    $this->usuarioGerenciamnto = new UsuarioGerenciamentoModel();
    $this->tipoModel = new TipoModel();
  }

  public function submissao()
  {
    $json_data = $this->request->getBody();
    $input = json_decode($json_data, true);

    if (!$input) {
      return $this->fail('Dados para submissão não enviados', 400);
    }

    $signatarios = $input['signatarios'] ?? [];
    unset($input['signatarios']);

    $resultado = $this->documentoModel->submissao($input);

    if (!$resultado) {
      return $this->fail('Erro ao submeter o documento', 400);
    }

    if (!empty($signatarios) && is_array($signatarios)) {
      $this->enviarParaAssinar($signatarios, $resultado, $input['nome']);
    }

    return $this->respond(['message' => 'Documento do código ' . $resultado . ' submetido'], 200);
  }

  public function enviarParaAssinar($signatarios, $codDoc, $nomeDoc)
  {
    foreach ($signatarios as $sig) {
      $usuario = $this->usuarioGerenciamnto->getUsuarioPorId($sig);

      if (!$usuario) {
        log_message('error', "Usuário não encontrado ao tentar enviar para assinatura.");
        continue;
      }

      $data = [
        'codUsuario' => $sig,
        'codigoDocumento' => $codDoc,
        'horario' => date('Y-m-d H:i:s'), // Formato correto para MySQL
        'situacao' => 'Pendente'
      ];

      try {
        $this->documentoUsuarioModel->criarAssinatura($data);
        enviarEmail($usuario['email'], $codDoc, $usuario['nome'], $nomeDoc);
      } catch (\Exception $e) {
        log_message('error', "Erro ao criar assinatura para usuário $sig: " . $e->getMessage());
      }
    }
  }
  public function assinar($codDocumento, $idUsuario)
  {
    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $idUsuario) {
      return $this->respond(['message' => 'Assinatura Negada!'], 401);
    }
    if(!$this->documentoUsuarioModel->verificarSignatario($codDocumento, $idUsuario)){
      return $this->respond(['message' => "O usuário não é signatário do documento", 401]);
    }else{
      if ($this->documentoUsuarioModel->assinar($codDocumento, $idUsuario)) {
        if ($this->documentoUsuarioModel->contarSignatarios($codDocumento) == $this->documentoUsuarioModel->contarAssinaturas($codDocumento)) {
          $this->documentoModel->mudarSituacao($codDocumento);
          return $this->respond(data: ['message' => "Documento assinado por todos", 200]);
        }
        return $this->respond(data: ['message' => "Documento assinado pelo usuario", 200]);
      }
    }
  }

  public function validacao($codigoDocumento, $comprovante)
  {
    $doc = $this->documentoModel->validacao($codigoDocumento, $comprovante);
    if ($doc != null) {
      return $this->respond(['message' => $doc], 200);
    } else {
      return $this->respond(['message' => "Erro ao validar"], 400);
    }
  }
  public function cancelarSubmissao($codDocumento, $idUsuario)
  {
    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $idUsuario) {
      return $this->respond(['message' => 'O usuário não tem acesso a estes dados'], 401);
    }

    if(!$this->documentoUsuarioModel->contarAssinaturas($codDocumento) > 0){
      if ($this->documentoModel->cancelarSubmissao($codDocumento)) {
        if ($this->documentoUsuarioModel->atualizarSituacao($codDocumento, 'Cancelado')) {
          return $this->respond(['message' => "Documento cancelado!"], 200);
        } else {
          return $this->respond(['message' => "Situação não alterada para os usuarios"], 400);
        }
      } else {
        return $this->respond(['message' => "Documento não encontrado"], 400);
      }
    }else{
      return $this->respond(['message' => "O documento já foi assinado por um usuário. Não foi possível cancelar"], 400);
    }
    
  }

  public function alterarAcesso()
  {
    $input = $this->request->getJSON(true);

    if (!isset($input['novoAcesso']) || !isset($input['codigoDocumento']) || !isset($input['idUsuario'])) {
      return $this->fail('Dados insuficientes', 400);
    }

    if ($this->documentoModel->alterarAcesso($input['novoAcesso'], $input['codigoDocumento'])) {
      return $this->respond(['message' => 'Acesso alterado com sucesso!'], 200);
    } else {
      return $this->respond(['message' => 'Erro ao alterar o acesso!'], 400);
    }

  }
  public function documentos()
  {
    $docs = $this->documentoModel->documentos();
    return $this->respond(['message' => $docs], 200);
  }

  public function documentosPorTipo($tipo)
  {
    $docs = $this->documentoModel->documentosPorTipo($tipo);
    return $this->respond(['message' => $docs], 200);
  }

  public function documentosPorUsuario($idUsuario)
  {
    $userId = json_decode($this->request->jwtUserId);

    if ($userId != $idUsuario) {
      return $this->respond(['message' => 'O usuário não tem acesso a estes dados'], 401);
    }
    $docs = $this->documentoModel->documentosPorUsuario($idUsuario);
    return $this->respond(['message' => $docs], 200);

  }

  public function documentosPorCodigo($codDocumento)
  {
    $doc = $this->documentoModel->buscarDocumento($codDocumento);
    return $this->respond(['message' => $doc], 200);

  }
  public function documentoUsuarios($codigoDocumento)
  {
    $docs = $this->documentoUsuarioModel->documentoUsuarios($codigoDocumento);
    return $this->respond(['message' => $docs], 200);
  }


  public function listarTiposDocumentos()
  {
    $tipos = $this->tipoModel->listarTipos();
    if ($tipos != null) {
      return $this->respond(['message' => $tipos], 200);
    } else {
      return $this->respond(['message' => "Erro ao listar"], 400);
    }
  }
}

