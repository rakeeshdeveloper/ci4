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
