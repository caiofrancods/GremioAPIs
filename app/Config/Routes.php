<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group(name: 'auth', callback: function ($routes) {
  $routes->post('armarios', 'AuthController::authUsuarioArmario');
});


// ------------ Armários ------------
$routes->group('armarios', ['filter' => 'jwt'], function ($routes) {
  $routes->get('/', 'ArmariosController::index');
  $routes->get('usuario/(:num)', 'ArmariosController::armariosPorUsuario/$1');
  $routes->get('infousuario/(:num)', 'ArmariosController::dadosUsuario/$1');
  $routes->get('usuario/solicitacao/alterarsenha/(:any)', 'ArmariosController::solicitarAlteracaoSenha/$1');
  $routes->post('usuario/cadastrar', 'ArmariosController::cadastroUsuario');
  $routes->put('usuario/alterarDados', 'ArmariosController::alterarDados');
  $routes->put('usuario/alterarSenha', 'ArmariosController::alterarSenha');
  $routes->put('transferir', 'ArmariosController::transferirArmario');
});

