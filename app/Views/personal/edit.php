<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Editar Personal Médico</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('personal/update/'.$item['idMedico_per']) ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">ID Personal</label>
                <input type="number" name="idPersonal_per" class="form-control" value="<?= esc($item['idPersonal_per']) ?>"></div>
            <div class="mb-2"><label class="form-label">Especialidad Médica</label>
                <input type="text" name="especialidadMedica_per" class="form-control" value="<?= esc($item['especialidadMedica_per']) ?>"></div>
            <div class="mb-2"><label class="form-label">Horario Laboral</label>
                <input type="text" name="horarioLaboral_per" class="form-control" value="<?= esc($item['horarioLaboral_per']) ?>"></div>
            <div class="mb-2"><label class="form-label">Nivel de Desempeño</label>
                <input type="number" step="0.1" name="nivelDesempeno_per" class="form-control" value="<?= esc($item['nivelDesempeno_per']) ?>"></div>
            <div class="mb-2"><label class="form-label">Tipo de Rol</label>
                <input type="text" name="tipoRol_per" class="form-control" value="<?= esc($item['tipoRol_per']) ?>"></div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('personal') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
