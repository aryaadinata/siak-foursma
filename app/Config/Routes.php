<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');

$routes->group('', ['filter' => 'filterlogin'], function ($routes) {
    $routes->get('/Ptk/detailguru/(:num)', 'Ptk::detailguru');
    $routes->get('/lihatguru/(:num)', 'Ptk::detailguru/$1');
    $routes->get('/Dashboard', 'Dashboard::index');
    $routes->get('/dashboard', 'dashboard::index');
    $routes->get('/Dashboard/(:segment)', 'Dashboard::$1');
    $routes->get('/dashboard/(:segment)', 'dashboard::$1');
    $routes->get('/admin/(:segment)', 'admin::$1');
    $routes->get('/Admin/(:segment)', 'Admin::$1');
    $routes->get('/Admin/biodata/', 'Admin::biodata/');
    $routes->get('/Ptk/(:segment)', 'Ptk::$1');
    //$routes->get('/dataguru', 'dataguru');
    //$routes->get('/lihatguru', 'lihatguru');
    //$routes->get('/datapegawai', 'datapegawai');
    //$routes->get('/lihatpegawai', 'lihatpegawai');
    $routes->get('/Perpustakaan', 'Perpustakaan::index');
    $routes->get('/Perpustakaan/(:segment)', 'Perpustakaan::$1');
    //$routes->get('/admin/buat_user', 'admin::buat_user', ['filter' => 'filterlogin']);

    $routes->get('/dataguru', 'Ptk::data_guru/');
    $routes->get('/Admin/biodatasiswa/(:num)', 'Admin::biodata/$1');
    $routes->get('/datapegawai', 'Ptk::data_pegawai');
    $routes->get('/lihatpegawai/(:num)', 'Ptk::detailguru/$1');
    $routes->get('/uploadfotoguru', 'Ptk::uploadfoto');
    $routes->get('/uploadfotopegawai', 'Ptk::uploadfoto');
    $routes->get('/importguru', 'Ptk::viewimport');
    $routes->get('/importpegawai', 'Ptk::viewimport');
});

$routes->group('', ['filter' => 'filtersiswa'], function ($routes) {
    $routes->get('/Siswa', 'Siswa::index');
    $routes->get('/Siswa/(:segment)', 'Siswa::$1');
    $routes->get('/Penunjang/(:segment)', 'Penunjang::$1');
    $routes->get('/Auth/ambilsession', 'Penunjang::prestasi');
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
