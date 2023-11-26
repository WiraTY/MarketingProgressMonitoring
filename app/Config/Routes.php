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
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

// Dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard/index', 'Dashboard::index');

// Progress
$routes->get('progress', 'Progress::index');
$routes->get('progress/daftar', 'Progress::index');
// Tambah Progress
$routes->get('progress/tambah', 'Progress::tambah');
$routes->post('progress/prosses_tambah', 'Progress::prosses_tambah');

$routes->get('progress/uploadGambar', 'Progress::uploadGambar');
// Edit Progress
$routes->get('progress/edit/(:num)', 'Progress::edit/$1');
$routes->post('progress/proses_edit/(:num)', 'Progress::proses_edit/$1');
// Delete Progress
$routes->get('member/delete/(:num)', 'Progress::delete/$1');

// Rekapitulasi
$routes->get('rekapitulasi', 'Rekapitulasi::index');

// Profil
$routes->get('profil/edit', 'Profil::edit');
$routes->post('profil/proses_edit', 'Profil::proses_edit');





// Route untuk tb_member
// $routes->get('member', 'Member::index');
// $routes->get('member/edit/(:num)', 'Member::edit/$1');
// $routes->post('member/edit/(:num)', 'Member::edit/$1');
$routes->get('member/create', 'Member::create');
$routes->post('member/create', 'Member::create');
// $routes->get('member/delete/(:num)', 'Member::delete/$1');

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
