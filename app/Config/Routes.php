<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TaskController::index');
$routes->get('/tasks', 'TaskController::list');
$routes->get('/tasks/create', 'TaskController::create');
$routes->post('/tasks/store', 'TaskController::store');
$routes->get('/tasks/edit/(:num)', 'TaskController::edit/$1');
$routes->post('/tasks/update/(:num)', 'TaskController::update/$1');
$routes->get('/tasks/delete/(:num)', 'TaskController::delete/$1');
$routes->get('/tasks/show/(:num)', 'TaskController::show/$1');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('tasks', 'TaskApi::index');
    $routes->get('tasks/(:num)', 'TaskApi::show/$1');
    $routes->post('tasks', 'TaskApi::create');
    $routes->put('tasks/(:num)', 'TaskApi::update/$1');
    $routes->delete('tasks/(:num)', 'TaskApi::delete/$1');
});

