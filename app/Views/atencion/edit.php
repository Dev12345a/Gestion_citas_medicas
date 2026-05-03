<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Editar Plan de Atención</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('atencion/update/'.$item['id']) ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Tipo de Plan de Atención</label>
                <input type="text" name="tipoPlanAtencion_ate" class="form-control" value="<?= esc($item['tipoPlanAtencion_ate']) ?>"></div>
            <div class="mb-2"><label class="form-label">Horario Disponible</label>
                <input type="text" name="horarioDisponible_ate" class="form-control" value="<?= esc($item['horarioDisponible_ate']) ?>"></div>
            <div class="mb-2"><label class="form-label">Promoción Activa</label>
                <input type="text" name="promocionActiva_ate" class="form-control" value="<?= esc($item['promocionActiva_ate']) ?>"></div>
            <div class="mb-2"><label class="form-label">Nivel de Personalización</label>
                <input type="text" name="nivelPersonalizacion_ate" class="form-control" value="<?= esc($item['nivelPersonalizacion_ate']) ?>"></div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('atencion') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
