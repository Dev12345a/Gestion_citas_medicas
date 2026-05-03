<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Personal Médico</h4></div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('personal/create') ?>" class="btn btn-primary mb-3">+ Nuevo Personal</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>ID Médico</th><th>ID Personal</th><th>Especialidad</th><th>Horario</th><th>Nivel Desempeño</th><th>Rol</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['idMedico_per'] ?></td>
            <td><?= esc($r['idPersonal_per']) ?></td>
            <td><?= esc($r['especialidadMedica_per']) ?></td>
            <td><?= esc($r['horarioLaboral_per']) ?></td>
            <td><?= esc($r['nivelDesempeno_per']) ?></td>
            <td><?= esc($r['tipoRol_per']) ?></td>
            <td>
                <a href="<?= base_url('personal/edit/'.$r['idMedico_per']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('personal/delete/'.$r['idMedico_per']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
