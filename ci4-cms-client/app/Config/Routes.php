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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/home/input_tempat', 'Home::input_tempat');
$routes->post('/home/input_profil', 'Home::input_profil');
$routes->post('/home/input_foto', 'Home::input_foto');
$routes->post('/home/input_tick', 'Home::input_tick');
$routes->get('/home/berirating', 'Home::berirating');
$routes->post('/home/input_rating', 'Home::input_rating');
$routes->post('/home/delete_foto', 'Home::delete_foto');
$routes->post('/home/delete_foto/(:any)', 'Home::delete_foto'); 
$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::login');
$routes->post('/ck_login', 'Home::ck_login');
$routes->get('/ck_logout', 'Home::ck_logout');
$routes->post('/home/delete_fasilitas', 'Home::delete_fasilitas');
// $routes->get('/home/(:any)', 'Home::index');

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
