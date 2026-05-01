<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Autenticación (sin filtro) ──────────────────────────────
$routes->get('login',  'AuthController::login');
$routes->post('login', 'AuthController::attempt');
$routes->get('logout', 'AuthController::logout');

// ── Raíz / Dashboard (protegido) ───────────────────────────
$routes->get('/',         'DashboardController::index', ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// ── Pacientes (protegido) ───────────────────────────────────
$routes->get('patients',                   'PatientController::index',        ['filter' => 'auth']);
$routes->get('patients/create',            'PatientController::create',       ['filter' => 'auth']);
$routes->post('patients/store',            'PatientController::store',        ['filter' => 'auth']);
$routes->get('patients/show/(:num)',       'PatientController::show/$1',      ['filter' => 'auth']);
$routes->get('patients/edit/(:num)',       'PatientController::edit/$1',      ['filter' => 'auth']);
$routes->post('patients/update/(:num)',    'PatientController::update/$1',    ['filter' => 'auth']);
$routes->get('patients/delete/(:num)',     'PatientController::delete/$1',    ['filter' => 'auth']);
$routes->get('patients/validate/(:any)',   'PatientController::validateCode/$1', ['filter' => 'auth']);

// ── Doctores (protegido) ────────────────────────────────────
$routes->get('doctors',                    'DoctorController::index',         ['filter' => 'auth']);
$routes->get('doctors/create',             'DoctorController::create',        ['filter' => 'auth']);
$routes->post('doctors/store',             'DoctorController::store',         ['filter' => 'auth']);
$routes->get('doctors/edit/(:num)',        'DoctorController::edit/$1',       ['filter' => 'auth']);
$routes->post('doctors/update/(:num)',     'DoctorController::update/$1',     ['filter' => 'auth']);
$routes->get('doctors/delete/(:num)',      'DoctorController::delete/$1',     ['filter' => 'auth']);
$routes->get('doctors/bySpecialty/(:num)', 'DoctorController::bySpecialty/$1', ['filter' => 'auth']);

// ── Citas (protegido) ───────────────────────────────────────
$routes->get('appointments',                        'AppointmentController::index',          ['filter' => 'auth']);
$routes->get('appointments/create',                 'AppointmentController::create',         ['filter' => 'auth']);
$routes->post('appointments/store',                 'AppointmentController::store',          ['filter' => 'auth']);
$routes->get('appointments/show/(:num)',            'AppointmentController::show/$1',        ['filter' => 'auth']);
$routes->get('appointments/edit/(:num)',            'AppointmentController::edit/$1',        ['filter' => 'auth']);
$routes->post('appointments/update/(:num)',         'AppointmentController::update/$1',      ['filter' => 'auth']);
$routes->get('appointments/cancel/(:num)',          'AppointmentController::cancel/$1',      ['filter' => 'auth']);
$routes->post('appointments/saveFollowUp/(:num)',   'AppointmentController::saveFollowUp/$1', ['filter' => 'auth']);

// ── Estadísticas (protegido) ────────────────────────────────
$routes->get('statistics', 'StatisticsController::statistics', ['filter' => 'auth']);
