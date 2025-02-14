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
  public function submissão(){

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
        $this->documentoUsuarioModel->insert($data);
        enviarEmail($usuario['email'], $codDoc, $usuario['nome'], $nomeDoc);
    }
  }
  public function assinar(){

  }

  public function validacao(){

  }
  public function cancelarSubmissao(){

  }

  public function mudarAcesso(){

  }
}

// $routes->group('assinatura', ['filter' => 'jwt'], function ($routes) {
//   $routes->get('documentos', 'AssinaturaController::index');
//   $routes->get('documentos/filtrarPorTipo/(:num)', 'AssinaturaController::armariosPorUsuario/$1');
//   $routes->get('tipos/(:num)', 'AssinaturaController::dadosUsuario/$1');
//   $routes->get('documentos/usuario/(:num)', 'AssinaturaController::solicitarAlteracaoSenha/$1');
//   $routes->get('documentos/verificar/(:num)/(:num)', 'AssinaturaController::solicitarAlteracaoSenha/$1/$2');
//   $routes->get('cancelar/(:num)', 'AssinaturaController::cadastroUsuario');
//   $routes->put('assinar/(:num)/(:num)', 'AssinaturaController::alterarDados');
//   $routes->put('acesso', 'AssinaturaController::alterarSenha');
//   $routes->put('listarTipos', 'AssinaturaController::transferirArmario');
// });