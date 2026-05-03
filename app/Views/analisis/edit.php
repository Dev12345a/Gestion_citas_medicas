<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Editar Análisis de Mercado</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('analisis/update/'.$item['id']) ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Nivel de Demanda</label>
                <select name="nivelDemanda_ana" class="form-select">
                    <?php foreach(['Alta','Media','Baja'] as $opt): ?>
                    <option <?= $item['nivelDemanda_ana']===$opt?'selected':'' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-2"><label class="form-label">Fecha de Análisis</label>
                <input type="date" name="fechaAnalisis_ana" class="form-control" value="<?= esc($item['fechaAnalisis_ana']) ?>"></div>
            <div class="mb-2"><label class="form-label">Nivel de Competencia</label>
                <select name="nivelCompetencia_ana" class="form-select">
                    <?php foreach(['Alta','Media','Baja'] as $opt): ?>
                    <option <?= $item['nivelCompetencia_ana']===$opt?'selected':'' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-2"><label class="form-label">Tendencia en Salud</label>
                <input type="text" name="tendenciaSalud_ana" class="form-control" value="<?= esc($item['tendenciaSalud_ana']) ?>"></div>
            <div class="mb-2"><label class="form-label">Normativa Vigente</label>
                <input type="text" name="normativaVigente_ana" class="form-control" value="<?= esc($item['normativaVigente_ana']) ?>"></div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('analisis') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
