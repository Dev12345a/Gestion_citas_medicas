<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Pacientes</h4>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <a href="<?= base_url('patients/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Registrar Paciente
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php if (empty($patients)): ?>
    <div class="alert alert-info">No hay pacientes registrados aún.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead class="table-white">
            <tr>
                <th>#</th>
                <th>Nombre Completo</th>
                <th>Historial Clínico</th>
                <th>Categoría</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $p): ?>
            <tr>
                <td><?= $p['idPaciente_pac'] ?></td>
                <td><?= esc($p['nombreCompleto_pac']) ?></td>
                <td><?= esc($p['historialClinico_pac']) ?></td>
                <td><?= esc($p['categoriaPaciente_pac']) ?></td>
                <td><?= esc($p['correoElectronico_pac'] ?? '-') ?></td>
                <td><?= esc($p['telefono_pac'] ?? '-') ?></td>
                <td><?= esc($p['direccion_pac'] ?? '-') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php echo view('footer'); ?>