<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Nuevo Personal Médico</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('personal/store') ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">ID Personal</label>
                <input type="number" name="idPersonal_per" class="form-control" value="<?= old('idPersonal_per') ?>" required></div>
            <div class="mb-2"><label class="form-label">Especialidad Médica</label>
                <input type="text" name="especialidadMedica_per" class="form-control" value="<?= old('especialidadMedica_per') ?>" required></div>
            <div class="mb-2"><label class="form-label">Horario Laboral</label>
                <input type="text" name="horarioLaboral_per" class="form-control" value="<?= old('horarioLaboral_per') ?>" placeholder="Ej: 08:00-16:00"></div>
            <div class="mb-2"><label class="form-label">Nivel de Desempeño</label>
                <input type="number" step="0.1" name="nivelDesempeno_per" class="form-control" value="<?= old('nivelDesempeno_per') ?>"></div>
            <div class="mb-2"><label class="form-label">Tipo de Rol</label>
                <input type="text" name="tipoRol_per" class="form-control" value="<?= old('tipoRol_per') ?>" placeholder="Médico / Enfermero / Administrativo"></div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('personal') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
