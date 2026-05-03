<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Análisis de Mercado</h4></div>
<?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<a href="<?= base_url('analisis/create') ?>" class="btn btn-primary mb-3">+ Nuevo Análisis</a>
<table class="table table-bordered table-sm">
    <thead class="table-dark">
        <tr><th>#</th><th>Nivel Demanda</th><th>Fecha Análisis</th><th>Nivel Competencia</th><th>Tendencia Salud</th><th>Normativa Vigente</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= esc($r['nivelDemanda_ana']) ?></td>
            <td><?= esc($r['fechaAnalisis_ana']) ?></td>
            <td><?= esc($r['nivelCompetencia_ana']) ?></td>
            <td><?= esc($r['tendenciaSalud_ana']) ?></td>
            <td><?= esc($r['normativaVigente_ana']) ?></td>
            <td>
                <a href="<?= base_url('analisis/edit/'.$r['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= base_url('analisis/delete/'.$r['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo view('footer'); ?>
