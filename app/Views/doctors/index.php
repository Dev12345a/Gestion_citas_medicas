<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Personal Médico</h4>
</div>

<p class="text-muted">Listado de doctores registrados en el sistema. <em>(Solo lectura)</em></p>

<?php if (empty($doctors)): ?>
    <div class="alert alert-info">No hay doctores registrados.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead class="table-white">
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nombre completo</th>
                <th>Especialidad</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Horario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doctors as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><?= esc($d['code']) ?></td>
                <td>Dr. <?= esc($d['first_name'] . ' ' . $d['last_name']) ?></td>
                <td><?= esc($d['specialty_name'] ?? '-') ?></td>
                <td><?= esc($d['email'] ?? '-') ?></td>
                <td><?= esc($d['phone'] ?? '-') ?></td>
                <td><?= esc($d['schedule'] ?? '-') ?></td>
                <td>
                    <?php if ($d['is_active']): ?>
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
