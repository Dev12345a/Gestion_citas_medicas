<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Nuevo Plan Estratégico</h4></div>
<div class="col-md-7">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('plan/store') ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Objetivo General</label>
                <input type="text" name="ObjetivoGeneral_pla" class="form-control" value="<?= old('ObjetivoGeneral_pla') ?>" required></div>
            <div class="mb-2"><label class="form-label">Misión del Sistema</label>
                <input type="text" name="misionSistema_pla" class="form-control" value="<?= old('misionSistema_pla') ?>"></div>
            <div class="mb-2"><label class="form-label">Visión del Sistema</label>
                <input type="text" name="visionSistema_pla" class="form-control" value="<?= old('visionSistema_pla') ?>"></div>
            <div class="mb-2"><label class="form-label">Indicador de Rendimiento (%)</label>
                <input type="number" step="0.01" name="indicadorRendimiento_pla" class="form-control" value="<?= old('indicadorRendimiento_pla') ?>"></div>
            <div class="mb-2"><label class="form-label">Meta Anual</label>
                <input type="number" name="metaAnual_pla" class="form-control" value="<?= old('metaAnual_pla') ?>"></div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('plan') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
