<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registerPost');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');

$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);


$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('users', 'User::index');
    $routes->get('users/create', 'User::create');
    $routes->post('users/store', 'User::store');
    $routes->get('users/edit/(:num)', 'User::edit/$1');
    $routes->post('users/update/(:num)', 'User::update/$1');
    $routes->get('users/delete/(:num)', 'User::delete/$1');
});



// API Routes
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    
    // Public auth endpoints
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->post('refresh-token', 'AuthController::refreshToken');
    
  // Protected routes with JWT filter
    $routes->group('', ['filter' => 'jwt'], function($routes) {
        $routes->get('profile', 'AuthController::profile');
        $routes->post('logout', 'AuthController::logout');
        
        // Users CRUD - SPECIFY HTTP METHODS EXPLICITLY
        $routes->get('users', 'UserController::index');
        $routes->get('users/(:num)', 'UserController::show/$1');
        $routes->post('users', 'UserController::store'); // Changed from create to store
        $routes->put('users/(:num)', 'UserController::update/$1');
        $routes->delete('users/(:num)', 'UserController::destroy/$1'); // Changed from delete to destroy
    });
    
});

