<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->setDefaultController('Login');
$routes->get('/', 'Login::index'); 

$route['logout'] = 'login/logout';




$route['translate_uri_dashes'] = FALSE;
$routes->setAutoRoute(true);