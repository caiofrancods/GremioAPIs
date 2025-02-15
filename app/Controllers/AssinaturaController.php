<?php

namespace App\Controllers;

use App\Models\DocumentoModel;
use App\Models\DocumentoUsuarioModel;
use App\Models\UsuarioGerenciamentoModel;
use CodeIgniter\RESTful\ResourceController;
helper(filenames: 'assinatura_helper');

class AssinaturaController extends ResourceController
{
  private $documentoModel;
  private $documentoUsuarioModel;

  private $usuarioGerenciamnto;


  public function __construct()
  {
    $this->documentoModel = new DocumentoModel();
    $this->documentoUsuarioModel = new DocumentoUsuarioModel();
    $this->usuarioGerenciamnto = new UsuarioGerenciamentoModel();
  }

  public function submissao()
  {
      $json_data = $this->request->getBody();
      $input = json_decode($json_data, true);
  
      if (!$input) {
          return $this->fail('Dados para submissão não enviados', 400);
      }
  
      // Remove 'signatarios' do array antes de salvar no banco
      $signatarios = $input['signatarios'] ?? []; // Se não existir, assume array vazio
      unset($input['signatarios']); 
  
      $resultado = $this->documentoModel->submissao($input);
  
      if (!$resultado) {
          return $this->fail('Erro ao submeter o documento', 400);
      }
  
      // Chama a função para enviar aos signatários
      if (!empty($signatarios) && is_array($signatarios)) {
          $this->enviarParaAssinar($signatarios, $resultado, $input['nome']);
      }
  
      return $this->respond(['message' => 'Documento do código '. $resultado . ' submetido'], 200);
  }
  
  public function enviarParaAssinar($signatarios, $codDoc, $nomeDoc)
  {
    foreach ($signatarios as $sig) {
      $usuario = $this->usuarioGerenciamnto->getUsuarioPorId($sig);

      if (!$usuario) {
        log_message('error', "Usuário não encontrado ao tentar enviar para assinatura.");
        continue; // Pula para o próximo signatário
      }

      $data = [
        'codUsuario' => $sig,
        'codigoDocumento' => $codDoc,
        'horario' => date('Y-m-d H:i:s'), // Formato correto para MySQL
        'situacao' => 'Pendente'
      ];

      try {
        $this->documentoUsuarioModel->criarAssinatura($data);
        $this->assinatura_helper->enviarEmail($usuario['email'], $codDoc, $usuario['nome'], $nomeDoc);
      } catch (\Exception $e) {
        log_message('error', "Erro ao criar assinatura para usuário $sig: " . $e->getMessage());
      }
    }
  }


  public function assinar($codDocumento, $idUsuario)
  {
    if ($this->documentoUsuarioModel->assinar($codDocumento, $idUsuario)) {
      if ($this->documentoUsuarioModel->contarSignatarios($codDocumento) == $this->documentoUsuarioModel->contarAssinaturas($codDocumento)) {
        $this->documentoModel->mudarSituacao($codDocumento);
        return $this->respond(data: ['message' => "Documento assinado por todos", 200]);
      }
      return $this->respond(data: ['message' => "Documento assinado pelo usuario", 200]);
    } else {
      return $this->respond(['message' => "Falha ao assinar o documento", 200]);
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
    if ($this->documentoModel->cancelarSubmissao($codDocumento)) {
      if ($this->documentoUsuarioModel->atualizarSituacao($codDocumento, 'Cancelado')) {
        return $this->respond(['message' => "Documento cancelado!"], 200);
      } else {
        return $this->respond(['message' => "Situação não alterada para os usuarios"], 400);
      }
    } else {
      return $this->respond(['message' => "Documento não encontrado"], 400);
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
    return $this->respond(['message' => "(Em breve) Tipos"], 200);
  }
}

