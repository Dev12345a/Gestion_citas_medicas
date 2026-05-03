<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <p class="text-muted">Sistema de Gestión Médica &mdash; <strong>MVP v0.1</strong></p>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                <h5>Pacientes</h5>
                <h2><?= $total_patients ?></h2>
                <a href="<?= base_url('patients') ?>" class="btn btn-primary btn-sm">Gestionar</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                <h5>Citas</h5>
                <h2><?= $total_appointments ?></h2>
                <a href="<?= base_url('appointments') ?>" class="btn btn-success btn-sm">Ver</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-stethoscope fa-2x text-info mb-2"></i>
                <h5>Servicios</h5>
                <h2><?= $total_servicios ?></h2>
                <a href="<?= base_url('servicios') ?>" class="btn btn-info btn-sm">Gestionar</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-user-md fa-2x text-warning mb-2"></i>
                <h5>Personal</h5>
                <h2><?= $total_personal ?></h2>
                <a href="<?= base_url('personal') ?>" class="btn btn-warning btn-sm">Gestionar</a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row mt-2">
    <div class="col-md-12">
        <h5>Todos los Módulos</h5>
        <table class="table table-bordered table-sm">
            <thead class="table-dark">
                <tr><th>Módulo</th><th>Tabla BD</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <tr><td>Pacientes</td><td><code>paciente</code></td><td><a href="<?= base_url('patients') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Citas Médicas</td><td><code>citas</code></td><td><a href="<?= base_url('appointments') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Servicios Médicos</td><td><code>serviciosmedicos</code></td><td><a href="<?= base_url('servicios') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Personal Médico</td><td><code>personal</code></td><td><a href="<?= base_url('personal') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Análisis de Mercado</td><td><code>analisismercado</code></td><td><a href="<?= base_url('analisis') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Planes de Atención</td><td><code>atencion</code></td><td><a href="<?= base_url('atencion') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Plan Estratégico</td><td><code>planestrategico</code></td><td><a href="<?= base_url('plan') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
                <tr><td>Usuarios del Sistema</td><td><code>sistema</code></td><td><a href="<?= base_url('sistema') ?>" class="btn btn-sm btn-primary">Abrir</a></td></tr>
            </tbody>
        </table>
    </div>
</div>

<?php echo view('footer'); ?>
