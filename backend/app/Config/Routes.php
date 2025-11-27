<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ----------------- Public Pages -----------------
$routes->get('/', 'Users::index');
$routes->get('/login', 'Users::login');
$routes->get('/signup', 'Users::signup');
$routes->get('/moodboard', 'Users::moodboard');
$routes->get('/roadmap', 'Users::roadmap');

// ----------------- Auth -----------------
$routes->post('signup', 'Auth::signup');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout');
$routes->get('logout', 'Auth::logout');

// ----------------- Admin Dashboard -----------------
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'AdminController::index');

    // Accounts CRUD
    $routes->get('accounts', 'AdminController::accounts');
    $routes->get('accounts/create', 'AdminController::createUser');
    $routes->post('accounts/store', 'AdminController::storeUser');
    $routes->get('accounts/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('accounts/update/(:num)', 'AdminController::updateUser/$1');
    $routes->get('accounts/delete/(:num)', 'AdminController::deleteUser/$1');
    $routes->post('accounts/delete/(:num)', 'AdminController::deleteUser/$1');

    // Menu CRUD
    $routes->get('menu', 'AdminController::menu');
    $routes->get('menu/create', 'AdminController::createItem');
    $routes->post('menu/store', 'AdminController::storeItem');
    $routes->get('menu/edit/(:num)', 'AdminController::editItem/$1');
    $routes->post('menu/update/(:num)', 'AdminController::updateItem/$1');
    $routes->get('menu/delete/(:num)', 'AdminController::deleteItem/$1');
    $routes->post('menu/delete/(:num)', 'AdminController::deleteItem/$1');

    // Orders CRUD
    $routes->get('orders', 'AdminController::orderRequests');
    $routes->get('orders/create', 'AdminController::createOrder');
    $routes->post('orders/store', 'AdminController::storeOrder');
    $routes->get('orders/edit/(:num)', 'AdminController::editOrder/$1');
    $routes->post('orders/update/(:num)', 'AdminController::updateOrder/$1');
    $routes->get('orders/delete/(:num)', 'AdminController::deleteOrder/$1');
    $routes->post('orders/delete/(:num)', 'AdminController::deleteOrder/$1');
    $routes->post('orders/complete/(:num)', 'AdminController::completeOrder/$1');
});


// ----------------- Client Routes -----------------
$routes->group('client', ['namespace' => 'App\Controllers\Client'], function ($routes) {

    // Dashboard
    $routes->get('home', 'ClientController::home');
    $routes->get('menu', 'ClientController::menu');
    $routes->post('order', 'ClientController::checkout');
    $routes->get('orders', 'ClientController::orders');


    // Profile
    $routes->get('profile', 'ClientController::profile');
    $routes->post('profile/delete', 'ClientController::deleteAccount');
    $routes->post('profile/update', 'ClientController::updateProfile');


    // Orders management
    $routes->post('orders/add', 'ClientController::addToOrders');
    $routes->post('orders/confirm', 'ClientController::confirmOrders');
    $routes->post('order/checkout', 'ClientController::checkout');
    $routes->post('order/complete', 'ClientController::completeOrder');
    $routes->post('orders/cancel/(:num)', 'ClientController::cancelOrder/$1');



    // Additional routes
    $routes->post('add-to-orders', 'ClientController::addToOrders');
    $routes->post('complete-order', 'ClientController::completeOrder');
});

// ----------------- Testing Routes (optional) -----------------
$routes->group('test', function ($routes) {
    $routes->get('show', 'CRUDTesting::showUsersPage');
    $routes->get('create', 'CRUDTesting::create');
    $routes->post('store', 'CRUDTesting::store');
    $routes->get('edit/(:num)', 'CRUDTesting::edit/$1');
    $routes->post('update/(:num)', 'CRUDTesting::update/$1');
    $routes->get('delete/(:num)', 'CRUDTesting::delete/$1');
});
