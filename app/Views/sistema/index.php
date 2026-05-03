<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Usuarios del Sistema</h4></div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('sistema/create') ?>" class="btn btn-primary mb-3">+ Nuevo Usuario</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>#</th><th>Usuario</th><th>Rol</th><th>Motor BD</th><th>Nivel Seguridad</th><th>Integración</th><th>Estado</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= esc($r['nombreUsuario_sis']) ?></td>
            <td><?= esc($r['rolUsuario_sis']) ?></td>
            <td><?= esc($r['motorBaseDatos_sis']) ?></td>
            <td><?= esc($r['nivelSeguridad_sis']) ?></td>
            <td><?= esc($r['tipoIntegracion_sis']) ?></td>
            <td><?= esc($r['estadoUsuario_sis']) ?></td>
            <td>
                <a href="<?= base_url('sistema/edit/'.$r['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('sistema/delete/'.$r['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
