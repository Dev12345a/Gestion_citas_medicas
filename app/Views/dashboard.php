<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    
    <p class="text-muted">Sistema de Gestión Médica &mdash; <strong>Fase de Desarrollo</strong></p>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5>Pacientes Registrados</h5>
                <h2><?= $total_patients ?></h2>
                <a href="<?= base_url('patients') ?>" class="btn btn-primary btn-sm">Ver Pacientes</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5>Citas en el Sistema</h5>
                <h2><?= $total_appointments ?></h2>
                <a href="<?= base_url('appointments') ?>" class="btn btn-secondary btn-sm">Ver Citas</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5>Doctores Registrados</h5>
                <h2><?= $total_doctors ?></h2>
                <a href="<?= base_url('doctors') ?>" class="btn btn-secondary btn-sm">Ver Doctores</a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row mt-3">
    <div class="col-md-12">
        <h5>Módulos del Sistema</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Módulo</th>
                    <th>Estado</th>
                    <th>Funciones disponibles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gestión de Pacientes</td>
                    <td><span class="badge bg-success">Funcional</span></td>
                    <td>Listar, Registrar paciente nuevo</td>
                </tr>
                <tr>
                    <td>Gestión de Citas</td>
                    <td><span class="badge bg-warning text-dark">Parcial</span></td>
                    <td>Solo lectura (agendar: en construcción)</td>
                </tr>
                <tr>
                    <td>Personal Médico</td>
                    <td><span class="badge bg-warning text-dark">Parcial</span></td>
                    <td>Solo lectura</td>
                </tr>
                <tr>
                    <td>Estadísticas</td>
                    <td><span class="badge bg-secondary">En Construcción</span></td>
                    <td>Próxima fase</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<p class="text-muted"><small>Bienvenido al Sistema de Gestión Médica &mdash; Fase de Desarrollo &mdash; Universidad 2026</small></p>

<?php echo view('footer'); ?>
