<?php

namespace Config;

use App\Controllers\Auth;
use App\Controllers\Home;
use App\Controllers\Usuario;
use App\Controllers\CentroTech;
use App\Controllers\Dispositivo;
use App\Controllers\Accidente;
use App\Controllers\Reporte;

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->addRedirect('/', '/login');

// Login
$routes->match(['get', 'post'], '/login', [Auth::class, 'login']);
$routes->get('/logout', [Auth::class, 'logout']);

// dashboard
$routes->get('/dashboard', [Home::class, 'index'], ['filter' => 'auth']);

// usuarios
$routes->get('/usuarios', [Usuario::class, 'index'], ['filter' => 'auth-admin']);
$routes->get('/usuarios/detalles/(:num)', [Usuario::class, 'detalles/$1'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/usuarios/agregar', [Usuario::class, 'agregar'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/usuarios/editar/(:num)', [Usuario::class, 'editar/$1'], ['filter' => 'auth-admin']);
$routes->get('/usuarios/eliminar/(:num)', [Usuario::class, 'eliminar/$1'], ['filter' => 'auth-admin']);
$routes->post('/usuarios/contrasenia/resetear', [Usuario::class, 'cambiarContrasenia'], ['filter' => 'auth-admin']);

// centros tech
$routes->get('/centros-tech', [CentroTech::class, 'index'], ['filter' => 'auth-admin']);
$routes->get('/centros-tech/detalles/(:num)', [CentroTech::class, 'detalles/$1'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/centros-tech/agregar', [CentroTech::class, 'agregar'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/centros-tech/editar/(:num)', [CentroTech::class, 'editar/$1'], ['filter' => 'auth-admin']);
$routes->get('/centros-tech/eliminar/(:num)', [CentroTech::class, 'eliminar/$1'], ['filter' => 'auth-admin']);

// dispositivos
$routes->get('/dispositivos', [Dispositivo::class, 'index'], ['filter' => 'auth-admin']);
$routes->get('/dispositivos/detalles/(:num)', [Dispositivo::class, 'detalles/$1'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/dispositivos/agregar', [Dispositivo::class, 'agregar'], ['filter' => 'auth-admin']);
$routes->match(['get', 'post'], '/dispositivos/editar/(:num)', [Dispositivo::class, 'editar/$1'], ['filter' => 'auth-admin']);
$routes->get('/dispositivos/eliminar/(:num)', [Dispositivo::class, 'eliminar/$1'], ['filter' => 'auth-admin']);

// accidentes
$routes->get('/accidentes', [Accidente::class, 'index'], ['filter' => 'auth']);
$routes->get('/accidentes/detalles/(:num)', [Accidente::class, 'detalles'], ['filter' => 'auth']);
$routes->match(['get', 'post'], '/accidentes/agregar', [Accidente::class, 'agregar'], ['filter' => 'auth']);
$routes->match(['get', 'post'], '/accidentes/resolucion/(:num)', [Accidente::class, 'resolucion/$1'], ['filter' => 'auth-admin']);
$routes->get('/accidentes/eliminar/(:num)', [Accidente::class, 'eliminar/$1'], ['filter' => 'auth-admin']);
$routes->get('/accidentes/ct/(:num)/dispositivos', [Accidente::class, 'obtenerDispositivosPorCentroTech/$1'], ['filter' => 'auth']);
$routes->post('/accidentes/cambiar-estado', [Accidente::class, 'cambiarEstado'], ['filter' => 'auth-admin']);

// reportes
$routes->get('/reportes', [Reporte::class, 'index'], ['filter' => 'auth-admin']); 

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
