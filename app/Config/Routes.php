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

$routes->get('armarios/(:any)', 'ArmariosController::armariosPorUsuario/$1');


// $routes->get('armarios/transferencia/(:destinatario)/(:armario)', 'ArmariosController::transferencia');

// $routes->get('armarios/auth', 'ArmariosController::auth');
// $routes->get('armarios/auth', 'ArmariosController::auth');
// $routes->get('armarios/auth', 'ArmariosController::auth');
// $routes->get('armarios/auth', 'ArmariosController::auth');
