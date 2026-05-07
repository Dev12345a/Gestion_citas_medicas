<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Citas Médicas</title>
    <meta name="description" content="Sistema Digital de Gestión de Citas Médicas y Seguimiento de Pacientes">

    <!-- Fonts and icons -->
    <script src="<?= base_url('public/assets/js/plugin/webfont/webfont.min.js') ?>"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: ["Font Awesome 5 Solid","Font Awesome 5 Regular","Font Awesome 5 Brands","simple-line-icons"],
                urls: ["<?= base_url('public/assets/css/fonts.min.css') ?>"],
            },
            active: function() { sessionStorage.fonts = true; },
        });
    </script>

    <!-- Bootstrap 5 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Bootstrap Icons + Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/plugins.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/kaiadmin.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/demo.css') ?>" />

    <style>
        .btn-toggle-left { height:40px; color:white; outline:none; border:none; }
        .btn-toggle-left:focus, .btn-toggle-left:active { outline:none; box-shadow:none; }
        .btn-toggle-left:hover { background:none !important; color:white !important; }

        /* Sidebar active item */
        .nav-secondary .nav-item.active > a,
        .nav-secondary .nav-item > a.active { color: #fff !important; font-weight: 600; }

        /* Badge de estado de citas */
        .badge-scheduled  { background-color:#6c757d; }
        .badge-confirmed  { background-color:#0d6efd; }
        .badge-completed  { background-color:#198754; }
        .badge-cancelled  { background-color:#dc3545; }
        .badge-no_show    { background-color:#fd7e14; }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <div class="nav-toggle">
                        <button class="btn btn-toggle-left toggle-sidebar"><i class="gg-menu-right"></i></button>
                        <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                    </div>
                    <div class="d-inline-block">
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
            </div>

            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <!-- Logo / Nombre del sistema -->
                    <div class="px-3 py-3 text-center border-bottom border-secondary mb-2">
                        <i class="fas fa-hospital-alt fa-2x text-info mb-1"></i>
                        <div class="text-white fw-bold small">Citas Médicas</div>
                    </div>

                    <ul class="nav nav-secondary">
                        <!-- Dashboard (todos) -->
                        <li class="nav-item <?= (uri_string() === '' || uri_string() === 'dashboard') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard') ?>">
                                <i class="fas fa-home"></i><p>Dashboard</p>
                            </a>
                        </li>

                        <?php if (session()->get('user_role') === 'doctor'): ?>
                        <!-- ===== MENÚ DOCTOR ===== -->
                        <li class="nav-item"><p class="nav-section"><span class="text-section" style="font-size:.7rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px">Gestión Clínica</span></p></li>
                        <li class="nav-item <?= strpos(uri_string(), 'patients') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('patients') ?>">
                                <i class="fas fa-users"></i><p>Mis Pacientes</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'appointments') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('appointments') ?>">
                                <i class="fas fa-calendar-check"></i><p>Mis Citas</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'servicios') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('servicios') ?>">
                                <i class="fas fa-stethoscope"></i><p>Servicios Médicos</p>
                            </a>
                        </li>

                        <li class="nav-item"><p class="nav-section"><span class="text-section" style="font-size:.7rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px">Administración</span></p></li>
                        <li class="nav-item <?= strpos(uri_string(), 'personal') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('personal') ?>">
                                <i class="fas fa-user-md"></i><p>Personal Médico</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'analisis') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('analisis') ?>">
                                <i class="fas fa-chart-bar"></i><p>Análisis Mercado</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'atencion') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('atencion') ?>">
                                <i class="fas fa-hand-holding-heart"></i><p>Planes de Atención</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'plan') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('plan') ?>">
                                <i class="fas fa-bullseye"></i><p>Plan Estratégico</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'sistema') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('sistema') ?>">
                                <i class="fas fa-cog"></i><p>Usuarios Sistema</p>
                            </a>
                        </li>
                        <?php else: ?>
                        <!-- ===== MENÚ PACIENTE ===== -->
                        <li class="nav-item"><p class="nav-section"><span class="text-section" style="font-size:.7rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px">Mi Área</span></p></li>
                        <li class="nav-item <?= strpos(uri_string(), 'appointments') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('appointments') ?>">
                                <i class="fas fa-calendar-check"></i><p>Mis Citas</p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(uri_string(), 'mi-perfil') !== false ? 'active' : '' ?>">
                            <a href="<?= base_url('mi-perfil') ?>">
                                <i class="fas fa-id-card"></i><p>Mi Perfil</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <!-- Cerrar sesión (todos) -->
                        <li class="nav-item mt-2">
                            <a href="<?= base_url('logout') ?>" style="color:#f87171">
                                <i class="fas fa-sign-out-alt"></i><p>Cerrar Sesión</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark"></div>
                </div>
                <!-- Navbar -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"></nav>
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= base_url('public/assets/img/profile.webp') ?>" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hola,</span>
                                        <span class="fw-bold"><?= session()->get('user_name') ?? 'Administrador' ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= base_url('public/assets/img/profile.webp') ?>" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= esc(session()->get('user_name') ?? 'Usuario') ?></h4>
                                                    <p class="text-muted">
                                                        <?php if (session()->get('user_role') === 'doctor'): ?>
                                                            <span class="badge bg-primary"><i class="fas fa-user-md me-1"></i>Doctor</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-success"><i class="fas fa-user me-1"></i>Paciente</span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <a href="<?= base_url('logout') ?>" class="btn btn-xs btn-danger mt-1"><i class="fas fa-sign-out-alt me-1"></i>Salir</a>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                                
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">