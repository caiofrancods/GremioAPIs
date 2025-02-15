<?php

namespace App\Controllers;

use App\Models\DocumentoModel;
use App\Models\UsuarioArmarioModel;
use CodeIgniter\RESTful\ResourceController;

class AssinaturaController extends ResourceController
{
  private $documentoModel;
  private $documentoUsuarioModel;
  

  public function __construct()
  {
    $this->documentoModel = new DocumentoModel();
    $this->documentoUsuarioModel = new UsuarioArmarioModel();
  }

  public function submissao(){
    $request = \Config\Services::request();

    $json_data = $request->getBody();
    $input = json_decode($json_data, true);

    if (!isset($input)) {
      return $this->fail('Dados para submissão não enviados', 400);
    }
    $resultado = $this->documentoModel->submissao($input);

    if ($resultado === "erro") {
      return $this->respond(['message' => "Erro ao submeter o documento"], 400);
    } else {
      $this->enviarParaAssinar($input['signatarios'], $input['codigoDocumento'], $input['nome']);
      return $this->respond(['message' => 'Documento submetido', 200]);
    }
  }
  public function enviarParaAssinar($signatarios, $codDoc, $nomeDoc)
  {
    foreach ($signatarios as $sig) {
        $usuario = $this->documentoUsuarioModel->buscarUsuarioPorId($sig);
        $data = [
            'codUsuario' => $sig,
            'codigoDocumento' => $codDoc,
            'horario' => date('d/m/Y H:i:s'),
            'situacao' => 'Pendente'
        ];
        $this->documentoUsuarioModel->criarAssinatura($data);
        enviarEmail($usuario['email'], $codDoc, $usuario['nome'], $nomeDoc);
    }
  }
  public function assinar($codDocumento, $idUsuario){
    if($this->documentoUsuarioModel->assinar($codDocumento, $idUsuario)){
      if($this->documentoUsuarioModel->contarSignatarios() == $this->documentoUsuarioModel->contarAssinaturas()){
        $this->documentoModel->mudarSituacao($codDocumento);
        return $this->respond(data: ['message' => "Documento assinado por todos", 200]);
      }
      return $this->respond(data: ['message' => "Documento assinado pelo usuario", 200]);
    }else{
      return $this->respond(['message' => "Falha ao assinar o documento", 200]);
    }    
  }

  public function validacao($codigoDocumento, $comprovante){
    $doc = $this->documentoModel->validacao($codigoDocumento,$comprovante);
    if($doc != null){
      return $this->respond(['message' => $doc], 200);
    }else{
      return $this->respond(['message' => "Erro ao validar"], 400);
    } 
  }
  public function cancelarSubmissao($codDocumento, $idUsuario){
    if($this->documentoModel->cancelarSubmissao($codDocumento)){
      if($this->documentoUsuarioModel->atualizarSituacao($codDocumento, 'Cancelado')){
        return $this->respond(['message' => "Documento cancelado!" . $idUsuario], 200);
      }else{
        return $this->respond(['message' => "Situação não alterada para os usuarios"], 400);
      }
    }else{
      return $this->respond(['message' => "Documento não encontrado"], 400);
    }
  }

  public function alterarAcesso(){
    $input = $this->request->getJSON(true);

    if (!isset($input['novoAcesso']) || !isset($input['codigoDocumento']) || !isset($input['idUsuario'])) {
      return $this->fail('Dados insuficientes', 400);
    }

    if($this->documentoModel->alterarAcesso($input['novoAcesso'], $input['codigo'])){
      return $this->respond(['message' => 'Acesso alterado com sucesso!'], 200);
    }else{
      return $this->respond(['message' => 'Erro ao alterar o acesso!'], 400);
    }
    
  }
  public function documentos(){
    $docs = $this->documentoModel->documentos();
    return $this->respond(['message' => $docs], 200);
  }

  public function documentosPorTipo($tipo){
    $docs = $this->documentoModel->documentosPorTipo($tipo);
    return $this->respond(['message' => $docs], 200);
  }

  public function documentosPorUsuario($idUsuario){
    $docs = $this->documentoModel->documentosPorUsuario($idUsuario);
    return $this->respond(['message' => $docs], 200);
    
  }
  public function documentoUsuarios($codigoDocumento){
    $docs = $this->documentoUsuarioModel->documentoUsuarios($codigoDocumento);
    return $this->respond(['message' => $docs], 200);
  }


  public function listarTiposDocumentos(){
    return $this->respond(['message' => "(Em breve) Tipos"], 200);
  }
}

