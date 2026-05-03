<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Nuevo Plan de Atención</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('atencion/store') ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Tipo de Plan de Atención</label>
                <input type="text" name="tipoPlanAtencion_ate" class="form-control" value="<?= old('tipoPlanAtencion_ate') ?>" required></div>
            <div class="mb-2"><label class="form-label">Horario Disponible</label>
                <input type="text" name="horarioDisponible_ate" class="form-control" value="<?= old('horarioDisponible_ate') ?>" placeholder="Ej: 08:00-12:00"></div>
            <div class="mb-2"><label class="form-label">Promoción Activa</label>
                <input type="text" name="promocionActiva_ate" class="form-control" value="<?= old('promocionActiva_ate') ?>"></div>
            <div class="mb-2"><label class="form-label">Nivel de Personalización</label>
                <input type="text" name="nivelPersonalizacion_ate" class="form-control" value="<?= old('nivelPersonalizacion_ate') ?>"></div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('atencion') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
