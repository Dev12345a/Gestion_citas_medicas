<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Nuevo Análisis de Mercado</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('analisis/store') ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Nivel de Demanda</label>
                <select name="nivelDemanda_ana" class="form-select"><option>Alta</option><option>Media</option><option>Baja</option></select></div>
            <div class="mb-2"><label class="form-label">Fecha de Análisis</label>
                <input type="date" name="fechaAnalisis_ana" class="form-control" value="<?= old('fechaAnalisis_ana') ?>" required></div>
            <div class="mb-2"><label class="form-label">Nivel de Competencia</label>
                <select name="nivelCompetencia_ana" class="form-select"><option>Alta</option><option>Media</option><option>Baja</option></select></div>
            <div class="mb-2"><label class="form-label">Tendencia en Salud</label>
                <input type="text" name="tendenciaSalud_ana" class="form-control" value="<?= old('tendenciaSalud_ana') ?>"></div>
            <div class="mb-2"><label class="form-label">Normativa Vigente</label>
                <input type="text" name="normativaVigente_ana" class="form-control" value="<?= old('normativaVigente_ana') ?>"></div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('analisis') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
