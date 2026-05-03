<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Planes de Atención</h4></div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('atencion/create') ?>" class="btn btn-primary mb-3">+ Nuevo Plan</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>#</th><th>Tipo de Plan</th><th>Horario Disponible</th><th>Promoción Activa</th><th>Nivel Personalización</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= esc($r['tipoPlanAtencion_ate']) ?></td>
            <td><?= esc($r['horarioDisponible_ate']) ?></td>
            <td><?= esc($r['promocionActiva_ate']) ?></td>
            <td><?= esc($r['nivelPersonalizacion_ate']) ?></td>
            <td>
                <a href="<?= base_url('atencion/edit/'.$r['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('atencion/delete/'.$r['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
