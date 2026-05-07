<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Autenticación (sin filtro) ──────────────────────────────
$routes->get('login',    'AuthController::login');
$routes->post('login',   'AuthController::attempt');
$routes->get('logout',   'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('register','AuthController::doRegister');

// ── Raíz / Dashboard (protegido — ambos roles) ──────────────
$routes->get('/',         'DashboardController::index', ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// ── Pacientes (doctor: todo; paciente: solo su perfil) ──────
// Los doctores pueden ver/crear/editar cualquier paciente
$routes->get('patients',                'PatientController::index',     ['filter' => 'doctor']);
$routes->get('patients/create',         'PatientController::create',    ['filter' => 'doctor']);
$routes->post('patients/store',         'PatientController::store',     ['filter' => 'doctor']);
$routes->get('patients/edit/(:num)',    'PatientController::edit/$1',   ['filter' => 'doctor']);
$routes->post('patients/update/(:num)', 'PatientController::update/$1', ['filter' => 'doctor']);
$routes->get('patients/delete/(:num)',  'PatientController::delete/$1', ['filter' => 'doctor']);
// El paciente puede ver/editar SU propio perfil
$routes->get('mi-perfil',              'PatientController::miPerfil',       ['filter' => 'auth']);
$routes->post('mi-perfil/update',      'PatientController::miPerfilUpdate', ['filter' => 'auth']);

// ── Citas (doctor: todo filtrado a sus citas; paciente: solo las suyas) ──
$routes->get('appointments',                     'AppointmentController::index',           ['filter' => 'auth']);
$routes->get('appointments/create',              'AppointmentController::create',          ['filter' => 'doctor']);
$routes->post('appointments/store',              'AppointmentController::store',           ['filter' => 'doctor']);
$routes->get('appointments/edit/(:any)',          'AppointmentController::edit/$1',         ['filter' => 'doctor']);
$routes->post('appointments/update/(:any)',       'AppointmentController::update/$1',       ['filter' => 'doctor']);
$routes->get('appointments/cancel/(:any)',        'AppointmentController::cancel/$1',       ['filter' => 'doctor']);
$routes->get('appointments/delete/(:any)',        'AppointmentController::delete/$1',       ['filter' => 'doctor']);
$routes->post('appointments/saveFollowUp/(:any)', 'AppointmentController::saveFollowUp/$1', ['filter' => 'doctor']);

// ── Servicios Médicos (solo doctores) ──────────────────────
$routes->get('servicios',                'ServiciosController::index',    ['filter' => 'doctor']);
$routes->get('servicios/create',         'ServiciosController::create',   ['filter' => 'doctor']);
$routes->post('servicios/store',         'ServiciosController::store',    ['filter' => 'doctor']);
$routes->get('servicios/edit/(:num)',    'ServiciosController::edit/$1',  ['filter' => 'doctor']);
$routes->post('servicios/update/(:num)', 'ServiciosController::update/$1',['filter' => 'doctor']);
$routes->get('servicios/delete/(:num)',  'ServiciosController::delete/$1',['filter' => 'doctor']);

// ── Personal Médico (solo doctores) ────────────────────────
$routes->get('personal',                'PersonalController::index',    ['filter' => 'doctor']);
$routes->get('personal/create',         'PersonalController::create',   ['filter' => 'doctor']);
$routes->post('personal/store',         'PersonalController::store',    ['filter' => 'doctor']);
$routes->get('personal/edit/(:num)',    'PersonalController::edit/$1',  ['filter' => 'doctor']);
$routes->post('personal/update/(:num)', 'PersonalController::update/$1',['filter' => 'doctor']);
$routes->get('personal/delete/(:num)',  'PersonalController::delete/$1',['filter' => 'doctor']);

// ── Análisis de Mercado (solo doctores) ────────────────────
$routes->get('analisis',                'AnalisisController::index',    ['filter' => 'doctor']);
$routes->get('analisis/create',         'AnalisisController::create',   ['filter' => 'doctor']);
$routes->post('analisis/store',         'AnalisisController::store',    ['filter' => 'doctor']);
$routes->get('analisis/edit/(:num)',    'AnalisisController::edit/$1',  ['filter' => 'doctor']);
$routes->post('analisis/update/(:num)', 'AnalisisController::update/$1',['filter' => 'doctor']);
$routes->get('analisis/delete/(:num)',  'AnalisisController::delete/$1',['filter' => 'doctor']);

// ── Planes de Atención (solo doctores) ─────────────────────
$routes->get('atencion',                'AtencionController::index',    ['filter' => 'doctor']);
$routes->get('atencion/create',         'AtencionController::create',   ['filter' => 'doctor']);
$routes->post('atencion/store',         'AtencionController::store',    ['filter' => 'doctor']);
$routes->get('atencion/edit/(:num)',    'AtencionController::edit/$1',  ['filter' => 'doctor']);
$routes->post('atencion/update/(:num)', 'AtencionController::update/$1',['filter' => 'doctor']);
$routes->get('atencion/delete/(:num)',  'AtencionController::delete/$1',['filter' => 'doctor']);

// ── Plan Estratégico (solo doctores) ───────────────────────
$routes->get('plan',                'PlanController::index',    ['filter' => 'doctor']);
$routes->get('plan/create',         'PlanController::create',   ['filter' => 'doctor']);
$routes->post('plan/store',         'PlanController::store',    ['filter' => 'doctor']);
$routes->get('plan/edit/(:num)',    'PlanController::edit/$1',  ['filter' => 'doctor']);
$routes->post('plan/update/(:num)', 'PlanController::update/$1',['filter' => 'doctor']);
$routes->get('plan/delete/(:num)',  'PlanController::delete/$1',['filter' => 'doctor']);

// ── Usuarios del Sistema (solo doctores) ───────────────────
$routes->get('sistema',                'SistemaController::index',    ['filter' => 'doctor']);
$routes->get('sistema/create',         'SistemaController::create',   ['filter' => 'doctor']);
$routes->post('sistema/store',         'SistemaController::store',    ['filter' => 'doctor']);
$routes->get('sistema/edit/(:num)',    'SistemaController::edit/$1',  ['filter' => 'doctor']);
$routes->post('sistema/update/(:num)', 'SistemaController::update/$1',['filter' => 'doctor']);
$routes->get('sistema/delete/(:num)',  'SistemaController::delete/$1',['filter' => 'doctor']);
