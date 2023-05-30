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
$routes->get('/api/terlaksana', 'Home::terlaksana', ['as' => 'api-terlaksana', 'filter' => 'auth']);
// $routes->get('/jurnal_test', function () {
//     return view('export/pdf_jurnal');
// });
$routes->post('/pdf/pegawai', 'PdfController::pegawai', ['as' => 'pdf-pegawai', 'filter' => 'auth']);
$routes->post('/pdf/jurnal', 'PdfController::jurnal', ['as' => 'pdf-jurnal', 'filter' => 'auth']);
$routes->post('/pdf/jurnal-bulan', 'PdfController::jurnal_bulan', ['as' => 'pdf-jurnal-bulan', 'filter' => 'auth']);

// Kinerja Section
$routes->get('/kinerja', 'Kinerja::index', ['as' => 'kinerja', 'filter' => 'auth']);
$routes->post('/kinerja/add', 'Kinerja::add', ['as' => 'kinerja-add', 'filter' => 'auth']);
$routes->get('/kinerja/edit/(:num)', 'Kinerja::edit/$1', ['as' => 'kinerja-edit', 'filter' => 'auth']);
$routes->post('/kinerja/delete', 'Kinerja::delete', ['as' => 'kinerja-delete', 'filter' => 'auth']);
$routes->post('/kinerja/update', 'Kinerja::update', ['as' => 'kinerja-update', 'filter' => 'auth']);
$routes->post('/kinerja/verif', 'Kinerja::verif', ['as' => 'kinerja-verif', 'filter' => 'auth']);

// Jurnal Section
$routes->get('/jurnal', 'Jurnal::index', ['as' => 'jurnal', 'filter' => 'auth']);
$routes->post('/jurnal/save', 'Jurnal::save', ['as' => 'jurnal-save', 'filter' => 'auth']);
$routes->get('/jurnal/add', 'Jurnal::add', ['as' => 'jurnal-add', 'filter' => 'auth']);
$routes->get('/jurnal/edit/(:num)', 'Jurnal::edit/$1', ['as' => 'jurnal-edit', 'filter' => 'auth']);
$routes->post('/jurnal/delete', 'Jurnal::delete', ['as' => 'jurnal-delete', 'filter' => 'auth']);
$routes->post('/jurnal/update', 'Jurnal::update', ['as' => 'jurnal-update', 'filter' => 'auth']);
$routes->post('/jurnal/verif', 'Jurnal::verif', ['as' => 'jurnal-verif', 'filter' => 'auth']);

// Pegawai Section
$routes->get('/pegawai', 'Pegawai::index', ['as' => 'pegawai', 'filter' => 'auth']);
$routes->post('/pegawai/save', 'Pegawai::save', ['as' => 'pegawai-save', 'filter' => 'auth:admin,pimpinan']);
$routes->get('/pegawai/add', 'Pegawai::add', ['as' => 'pegawai-add', 'filter' => 'auth:admin,pimpinan']);
$routes->get('/pegawai/edit/(:num)', 'Pegawai::edit/$1', ['as' => 'pegawai-edit', 'filter' => 'auth:admin,pimpinan']);
$routes->post('/pegawai/delete', 'Pegawai::delete', ['as' => 'pegawai-delete', 'filter' => 'auth:admin,pimpinan']);
$routes->post('/pegawai/update', 'Pegawai::update', ['as' => 'pegawai-update', 'filter' => 'auth:admin,pimpinan']);

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
