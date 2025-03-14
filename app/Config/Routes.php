<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/home', 'HomeController::index');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('login', 'AuthController::index'); 
$routes->post('api/login', 'AuthController::login'); 
$routes->get('/logout', 'AuthController::logout');
$routes->get('/profile', 'ProfileController::view');
$routes->get('/profile/edit', 'ProfileController::edit');
$routes->get('/topup', 'TransactionController::index'); 
$routes->get('transaction/payment/(:num)', 'TransactionController::payment/$1');
$routes->get('/history', 'HistoryController::index');
$routes->get('/history/more', 'HistoryController::loadMore');


