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

// ── Citas (protegido) ───────────────────────────────────────
$routes->get('appointments',                        'AppointmentController::index',          ['filter' => 'auth']);
$routes->get('appointments/create',                 'AppointmentController::create',         ['filter' => 'auth']);
$routes->post('appointments/store',                 'AppointmentController::store',          ['filter' => 'auth']);
$routes->get('appointments/show/(:num)',            'AppointmentController::show/$1',        ['filter' => 'auth']);
$routes->get('appointments/edit/(:num)',            'AppointmentController::edit/$1',        ['filter' => 'auth']);
$routes->post('appointments/update/(:num)',         'AppointmentController::update/$1',      ['filter' => 'auth']);
$routes->get('appointments/cancel/(:num)',          'AppointmentController::cancel/$1',      ['filter' => 'auth']);
$routes->post('appointments/saveFollowUp/(:num)',   'AppointmentController::saveFollowUp/$1', ['filter' => 'auth']);

// ── Servicios Médicos (protegido) ───────────────────────────
$routes->get('servicios',               'ServiciosController::index',    ['filter' => 'auth']);
$routes->get('servicios/create',        'ServiciosController::create',   ['filter' => 'auth']);
$routes->post('servicios/store',        'ServiciosController::store',    ['filter' => 'auth']);
$routes->get('servicios/edit/(:num)',   'ServiciosController::edit/$1',  ['filter' => 'auth']);
$routes->post('servicios/update/(:num)','ServiciosController::update/$1',['filter' => 'auth']);
$routes->get('servicios/delete/(:num)', 'ServiciosController::delete/$1',['filter' => 'auth']);

// ── Personal Médico (protegido) ─────────────────────────────
$routes->get('personal',               'PersonalController::index',    ['filter' => 'auth']);
$routes->get('personal/create',        'PersonalController::create',   ['filter' => 'auth']);
$routes->post('personal/store',        'PersonalController::store',    ['filter' => 'auth']);
$routes->get('personal/edit/(:num)',   'PersonalController::edit/$1',  ['filter' => 'auth']);
$routes->post('personal/update/(:num)','PersonalController::update/$1',['filter' => 'auth']);
$routes->get('personal/delete/(:num)', 'PersonalController::delete/$1',['filter' => 'auth']);

// ── Análisis de Mercado (protegido) ─────────────────────────
$routes->get('analisis',               'AnalisisController::index',    ['filter' => 'auth']);
$routes->get('analisis/create',        'AnalisisController::create',   ['filter' => 'auth']);
$routes->post('analisis/store',        'AnalisisController::store',    ['filter' => 'auth']);
$routes->get('analisis/edit/(:num)',   'AnalisisController::edit/$1',  ['filter' => 'auth']);
$routes->post('analisis/update/(:num)','AnalisisController::update/$1',['filter' => 'auth']);
$routes->get('analisis/delete/(:num)', 'AnalisisController::delete/$1',['filter' => 'auth']);

// ── Planes de Atención (protegido) ──────────────────────────
$routes->get('atencion',               'AtencionController::index',    ['filter' => 'auth']);
$routes->get('atencion/create',        'AtencionController::create',   ['filter' => 'auth']);
$routes->post('atencion/store',        'AtencionController::store',    ['filter' => 'auth']);
$routes->get('atencion/edit/(:num)',   'AtencionController::edit/$1',  ['filter' => 'auth']);
$routes->post('atencion/update/(:num)','AtencionController::update/$1',['filter' => 'auth']);
$routes->get('atencion/delete/(:num)', 'AtencionController::delete/$1',['filter' => 'auth']);

// ── Plan Estratégico (protegido) ────────────────────────────
$routes->get('plan',               'PlanController::index',    ['filter' => 'auth']);
$routes->get('plan/create',        'PlanController::create',   ['filter' => 'auth']);
$routes->post('plan/store',        'PlanController::store',    ['filter' => 'auth']);
$routes->get('plan/edit/(:num)',   'PlanController::edit/$1',  ['filter' => 'auth']);
$routes->post('plan/update/(:num)','PlanController::update/$1',['filter' => 'auth']);
$routes->get('plan/delete/(:num)', 'PlanController::delete/$1',['filter' => 'auth']);

// ── Usuarios del Sistema (protegido) ────────────────────────
$routes->get('sistema',               'SistemaController::index',    ['filter' => 'auth']);
$routes->get('sistema/create',        'SistemaController::create',   ['filter' => 'auth']);
$routes->post('sistema/store',        'SistemaController::store',    ['filter' => 'auth']);
$routes->get('sistema/edit/(:num)',   'SistemaController::edit/$1',  ['filter' => 'auth']);
$routes->post('sistema/update/(:num)','SistemaController::update/$1',['filter' => 'auth']);
$routes->get('sistema/delete/(:num)', 'SistemaController::delete/$1',['filter' => 'auth']);

// ── Stubs conservados (no funcionales en MVP) ───────────────
$routes->get('doctors',                    'DoctorController::index',         ['filter' => 'auth']);
$routes->get('doctors/create',             'DoctorController::create',        ['filter' => 'auth']);
$routes->post('doctors/store',             'DoctorController::store',         ['filter' => 'auth']);
$routes->get('doctors/edit/(:num)',        'DoctorController::edit/$1',       ['filter' => 'auth']);
$routes->post('doctors/update/(:num)',     'DoctorController::update/$1',     ['filter' => 'auth']);
$routes->get('doctors/delete/(:num)',      'DoctorController::delete/$1',     ['filter' => 'auth']);
$routes->get('doctors/bySpecialty/(:num)', 'DoctorController::bySpecialty/$1', ['filter' => 'auth']);
$routes->get('statistics', 'StatisticsController::statistics', ['filter' => 'auth']);
