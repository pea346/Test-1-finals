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
$routes->get('/admin/dashboard', 'Admin\Dashboard::index');
$routes->get('/admin/menu', 'Admin\Dashboard::menu'); //renamed
$routes->get('/admin/accounts', 'Admin\Dashboard::accounts');
$routes->get('/admin/orders', 'Admin\Dashboard::orderRequests'); // renamed

// ----------------- Admin Accounts CRUD -----------------
$routes->get('/admin/accounts/create', 'Admin\Dashboard::createUser');
$routes->post('/admin/accounts/store', 'Admin\Dashboard::storeUser');
$routes->get('/admin/accounts/edit/(:num)', 'Admin\Dashboard::editUser/$1');
$routes->post('/admin/accounts/update/(:num)', 'Admin\Dashboard::updateUser/$1');
$routes->get('/admin/accounts/delete/(:num)', 'Admin\Dashboard::deleteUser/$1');
$routes->post('/admin/accounts/delete/(:num)', 'Admin\Dashboard::deleteUser/$1');



// ----------------- Admin Menu Items CRUD -----------------
$routes->get('/admin/menu', 'Admin\Dashboard::menu');
$routes->get('/admin/menu-items', 'Admin\Dashboard::menuItems');
$routes->get('/admin/menu/create', 'Admin\Dashboard::createItem');
$routes->post('/admin/menu/store', 'Admin\Dashboard::storeItem');
$routes->post('/admin/menu-items/store', 'Admin\Dashboard::storeItem');
$routes->get('/admin/menu/edit/(:num)', 'Admin\Dashboard::editItem/$1');
$routes->post('/admin/menu-items/update/(:num)', 'Admin\Dashboard::updateItem/$1');
$routes->get('/admin/menu/delete/(:num)', 'Admin\Dashboard::deleteItem/$1');
$routes->post('/admin/menu/delete/(:num)', 'Admin\Dashboard::deleteItem/$1');





// ----------------- Admin Order Requests CRUD -----------------
$routes->get('/admin/orders', 'Admin\Dashboard::orderRequests'); // list all
$routes->get('/admin/orders/create', 'Admin\Dashboard::createOrder'); // create form
$routes->post('/admin/orders/store', 'Admin\Dashboard::storeOrder'); // store new order
$routes->get('/admin/orders/edit/(:num)', 'Admin\Dashboard::editOrder/$1'); // edit form
$routes->post('/admin/orders/update/(:num)', 'Admin\Dashboard::updateOrder/$1'); // update order
$routes->get('/admin/orders/delete/(:num)', 'Admin\Dashboard::deleteOrder/$1'); // delete order
$routes->post('/admin/orders/delete/(:num)', 'Admin\Dashboard::deleteOrder/$1');
$routes->post('admin/menu-items/store', 'Admin\MenuItemsController::store');






// ----------------- Testing Routes (optional) -----------------
$routes->get('/test/show', 'CRUDTesting::showUsersPage');
$routes->get('/test/create', 'CRUDTesting::create');
$routes->post('/test/store', 'CRUDTesting::store');
$routes->get('/test/edit/(:num)', 'CRUDTesting::edit/$1');
$routes->post('/test/update/(:num)', 'CRUDTesting::update/$1');
$routes->get('/test/delete/(:num)', 'CRUDTesting::delete/$1');
