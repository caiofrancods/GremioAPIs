<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ------------ Teste e Controle ------------

$routes->get('/', 'Home::index');
$routes->get('hello', 'HelloController::index');
$routes->get('multidb', 'MultiDBController::index');

// ------------ Armários ------------
$routes->get('armarios/auth/(:any)/(:any)', 'ArmariosController::auth/$1/$2');
$routes->get('armarios', 'ArmariosController::index');
$routes->get('armarios/usuario/(:num)', 'ArmariosController::dadosUsuario/$1');
$routes->get('armarios/infousuario/(:num)', 'ArmariosController::dadosUsuario/$1');
$routes->get('armarios/usuario/solicitacao/alterarsenha/(:any)', 'ArmariosController::solicitarAlteracaoSenha/$1');

$routes->post('armarios/usuario/cadastrar', 'ArmariosController::cadastroUsuario');
$routes->put('armarios/usuario/alterarDados', 'ArmariosController::alterarDados');
$routes->put('armarios/usuario/alterarSenha', 'ArmariosController::alterarSenha');
$routes->put('armarios/transferir', 'ArmariosController::transferirArmario');


// $routes->get('armarios/auth', 'ArmariosController::auth');
// $routes->get('armarios/auth', 'ArmariosController::auth');
// $routes->get('armarios/auth', 'ArmariosController::auth');
