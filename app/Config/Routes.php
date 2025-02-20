<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/recuperacaoSenha', 'Home::recuperacaoSenha');

$routes->group(name: 'auth', callback: function ($routes) {
  $routes->post('armarios', 'AuthController::authUsuarioArmario');
  $routes->post('gerencia', 'AuthController::authUsuarioGerenciamento');
});


// ------------ Armários ------------
$routes->group('armarios', ['filter' => 'jwt'], function ($routes) {
  $routes->get('/', 'ArmariosController::index');
  $routes->get('usuario/(:num)', 'ArmariosController::armariosPorUsuario/$1');
  $routes->get('infousuario/(:num)', 'ArmariosController::dadosUsuario/$1');
  $routes->put('usuario/alterarDados', 'ArmariosController::alterarDados');
  $routes->put('transferir', 'ArmariosController::transferirArmario');
});
$routes->get('armarios/usuario/solicitacao/alterarsenha/(:any)', 'ArmariosController::solicitarAlteracaoSenha/$1');
$routes->get('armarios/validar/(:any)/(:any)', 'ArmariosController::validacao/$1/$2');
$routes->get('armarios/usuario/listarCursos', 'ArmariosController::listarCursos');
$routes->post('armarios/usuario/cadastrar', 'ArmariosController::cadastroUsuario');
$routes->put('armarios/usuario/alterarSenha', 'ArmariosController::alterarSenha');

// ------------ Assinatura ------------
$routes->group('assinatura', ['filter' => 'jwt'], function ($routes) {
  // $routes->group('assinatura', function ($routes) {
   $routes->get('documentos', 'AssinaturaController::documentos');
   $routes->get('documento/(:num)', 'AssinaturaController::documentosPorCodigo/$1');
   $routes->get('documentos/tipo/(:num)', 'AssinaturaController::documentosPorTipo/$1');
   
   $routes->get('documentos/usuario/(:num)', 'AssinaturaController::documentosPorUsuario/$1');
   $routes->get('cancelar/(:num)/(:num)', 'AssinaturaController::cancelarSubmissao/$1/$2');
   $routes->post('submissao', 'AssinaturaController::submissao');
   $routes->get('assinar/(:num)/(:num)', 'AssinaturaController::assinar/$1/$2');
   $routes->put('acesso', 'AssinaturaController::alterarAcesso');
   $routes->get('documentoUsuarios/(:num)', 'AssinaturaController::documentoUsuarios/$1');
  });

  $routes->get('assinatura/validar/(:num)/(:any)', 'AssinaturaController::validacao/$1/$2');
  $routes->get('assinatura/listarTipos', 'AssinaturaController::listarTiposDocumentos');