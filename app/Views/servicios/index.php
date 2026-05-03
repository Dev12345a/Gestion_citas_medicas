<?php echo view('header'); ?>
<div class="page-header">
    <h4 class="page-title">Servicios Médicos</h4>
</div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('servicios/create') ?>" class="btn btn-primary mb-3">+ Nuevo Servicio</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>#</th><th>Nombre</th><th>Estado</th><th>Precio</th><th>Rentabilidad %</th><th>Paquete</th><th>Duración (min)</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['idServicio_ser'] ?></td>
            <td><?= esc($r['nombreServicio_ser']) ?></td>
            <td><?= esc($r['estadoServicio_ser']) ?></td>
            <td>$<?= esc($r['precioConsulta_ser']) ?></td>
            <td><?= esc($r['porcentajeRentabilidad_ser']) ?>%</td>
            <td><?= esc($r['tipoPaquete_ser']) ?></td>
            <td><?= esc($r['duracionServicio_ser']) ?></td>
            <td>
                <a href="<?= base_url('servicios/edit/'.$r['idServicio_ser']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('servicios/delete/'.$r['idServicio_ser']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
