<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->get('/create-db', function(){
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('yN')) {
        echo 'Database created!';
    }
});

$routes->get('/login', 'auth::login');

$routes->get('/', 'Home::index');
$routes->get('/coba', 'Home::coba');
// $routes->addRedirect('/', 'home');
$routes->get('/gawe', 'Gawe::index');
$routes->get('/gawe/add', 'Gawe::create');
$routes->post('/gawe', 'Gawe::store');
$routes->get('/gawe/edit/(:any)', 'Gawe::edit/$1 ');
$routes->put('/gawe/(:any)', 'Gawe::update/$1 ');
$routes->delete('/gawe/(:segment)', 'Gawe::destroy/$1 ');

$routes->get('groups/trash', 'groups::trash');
$routes->get('groups/restore/(:any)', 'groups::restore/$1');
$routes->get('groups/restore', 'groups::restore');
$routes->get('groups/delete2/(:any)', 'groups::delete2/$1');
$routes->get('groups/delete2', 'groups::delete2');
$routes->presenter('groups', ['filter' => 'isLoggedIn']); // cara ke 2 buat pake filter di dalam routes [18] , cara ke 1 di config/filter

$routes->resource('contacts', ['filter' => 'isLoggedIn']);

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
