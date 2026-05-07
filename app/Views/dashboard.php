<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <p class="text-muted">Sistema de Gestión Médica &mdash; <strong>MVP v0.1</strong></p>
</div>



<hr>

<div class="row mt-2">
    <div class="col-md-12">
        <h5>Todos los Módulos</h5>
        <table class="table table-bordered table-sm">
            <thead class="table-white">
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
