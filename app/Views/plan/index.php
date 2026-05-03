<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Plan Estratégico</h4></div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('plan/create') ?>" class="btn btn-primary mb-3">+ Nuevo Plan</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>#</th><th>Objetivo General</th><th>Misión</th><th>Visión</th><th>Indicador Rendimiento</th><th>Meta Anual</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= esc($r['ObjetivoGeneral_pla']) ?></td>
            <td><?= esc($r['misionSistema_pla']) ?></td>
            <td><?= esc($r['visionSistema_pla']) ?></td>
            <td><?= esc($r['indicadorRendimiento_pla']) ?>%</td>
            <td><?= esc($r['metaAnual_pla']) ?></td>
            <td>
                <a href="<?= base_url('plan/edit/'.$r['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('plan/delete/'.$r['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
