<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/admin', function () {
//     echo 'mantap';
// }, ['as' => 'home', 'filter' => 'auth:admin']);

$routes->get('/', 'Home::index', ['as' => 'home', 'filter' => 'auth']);
$routes->post('/pdf/spt', 'PdfController::spt', ['as' => 'pdf-spt', 'filter' => 'auth']);
$routes->post('/pdf/kwitansi', 'PdfController::kwitansi', ['as' => 'pdf-kwitansi', 'filter' => 'auth']);

// Kinerja Section
$routes->get('/kinerja', 'Kinerja::index', ['as' => 'kinerja', 'filter' => 'auth']);
$routes->post('/kinerja/add', 'Kinerja::add', ['as' => 'kinerja-add', 'filter' => 'auth']);
$routes->get('/kinerja/edit/(:num)', 'Kinerja::edit/$1', ['as' => 'kinerja-edit', 'filter' => 'auth']);
$routes->post('/kinerja/delete', 'Kinerja::delete', ['as' => 'kinerja-delete', 'filter' => 'auth']);
$routes->post('/kinerja/update', 'Kinerja::update', ['as' => 'kinerja-update', 'filter' => 'auth']);

// Jurnal Section
$routes->get('/jurnal', 'Jurnal::index', ['as' => 'jurnal', 'filter' => 'auth']);
$routes->post('/jurnal/save', 'Jurnal::save', ['as' => 'jurnal-save', 'filter' => 'auth']);
$routes->get('/jurnal/add', 'Jurnal::add', ['as' => 'jurnal-add', 'filter' => 'auth']);
$routes->get('/jurnal/edit/(:num)', 'Jurnal::edit/$1', ['as' => 'jurnal-edit', 'filter' => 'auth']);
$routes->post('/jurnal/delete', 'Jurnal::delete', ['as' => 'jurnal-delete', 'filter' => 'auth']);
$routes->post('/jurnal/update', 'Jurnal::update', ['as' => 'jurnal-update', 'filter' => 'auth']);

// Users Section
$routes->get('/users', 'Users::index', ['as' => 'users', 'filter' => 'auth:admin']);
$routes->post('/users/add', 'Users::add', ['as' => 'users-add', 'filter' => 'auth:admin']);
$routes->post('/users/delete', 'Users::delete', ['as' => 'users-delete', 'filter' => 'auth:admin']);
$routes->post('/users/update', 'Users::update', ['as' => 'users-update', 'filter' => 'auth:admin']);

// Authentication Section
$routes->get('/login', 'Auth::index', ['as' => 'login']);
$routes->post('/login/auth', 'Auth::auth', ['as' => 'auth']);
$routes->get('/logout', 'Auth::logout', ['as' => 'logout']);

// Setting Section
$routes->get('/setting', 'Setting::index', ['as' => 'setting', 'filter' => 'auth']);
$routes->post('/setting/update', 'Setting::update', ['as' => 'setting-update', 'filter' => 'auth']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
