<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Pacientes</h4>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <a href="<?= base_url('patients/create') ?>" class="btn btn-primary">+ Registrar Paciente</a>
    </div>
</div>

<?php if (empty($patients)): ?>
    <div class="alert alert-info">No hay pacientes registrados aún.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nombre completo</th>
                <th>Género</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Tipo de sangre</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= esc($p['code']) ?></td>
                <td><?= esc($p['first_name'] . ' ' . $p['last_name']) ?></td>
                <td><?= esc($p['gender']) ?></td>
                <td><?= esc($p['phone'] ?? '-') ?></td>
                <td><?= esc($p['email'] ?? '-') ?></td>
                <td><?= esc($p['blood_type'] ?? '-') ?></td>
                <td>
                    <?php if ($p['is_active']): ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Inactivo</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php echo view('footer'); ?>