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
    $routes->get('dashboard', 'Dashboard::index');

    // Accounts CRUD
    $routes->get('accounts', 'Dashboard::accounts');
    $routes->get('accounts/create', 'Dashboard::createUser');
    $routes->post('accounts/store', 'Dashboard::storeUser');
    $routes->get('accounts/edit/(:num)', 'Dashboard::editUser/$1');
    $routes->post('accounts/update/(:num)', 'Dashboard::updateUser/$1');
    $routes->get('accounts/delete/(:num)', 'Dashboard::deleteUser/$1');
    $routes->post('accounts/delete/(:num)', 'Dashboard::deleteUser/$1');

    // Menu CRUD
    $routes->get('menu', 'Dashboard::menu'); // list all items
    $routes->get('menu/create', 'Dashboard::createItem');
    $routes->get('menu/store', 'Dashboard::storeItem');
    $routes->post('menu/store', 'Dashboard::storeItem');
    $routes->get('menu/edit/(:num)', 'Dashboard::editItem/$1');
    $routes->post('menu/update/(:num)', 'Dashboard::updateItem/$1');
    $routes->get('menu/delete/(:num)', 'Dashboard::deleteItem/$1');
    $routes->post('menu/delete/(:num)', 'Dashboard::deleteItem/$1');

    // Orders CRUD
    $routes->get('orders', 'Dashboard::orderRequests');
    $routes->get('orders/create', 'Dashboard::createOrder');
    $routes->post('orders/store', 'Dashboard::storeOrder');
    $routes->get('orders/edit/(:num)', 'Dashboard::editOrder/$1');
    $routes->post('orders/update/(:num)', 'Dashboard::updateOrder/$1');
    $routes->get('orders/delete/(:num)', 'Dashboard::deleteOrder/$1');
    $routes->post('orders/delete/(:num)', 'Dashboard::deleteOrder/$1');
    $routes->post('orders/complete/(:num)', 'Dashboard::completeOrder/$1');
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
