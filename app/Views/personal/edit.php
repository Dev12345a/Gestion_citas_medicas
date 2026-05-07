<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-user-edit me-2 text-warning"></i>Editar Personal Médico</h4>
    <a href="<?= base_url('personal') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Médico ID: <?= $item['idMedico_per'] ?></h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('personal/update/'.$item['idMedico_per']) ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="idPersonal_per" class="form-label">ID Personal</label>
                            <input type="number" id="idPersonal_per" name="idPersonal_per" class="form-control"
                                   value="<?= old('idPersonal_per', $item['idPersonal_per']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tipoRol_per" class="form-label">Tipo de Rol <span class="text-danger">*</span></label>
                            <select id="tipoRol_per" name="tipoRol_per" class="form-select" required>
                                <?php foreach (['Médico','Administrativo','Enfermero','Técnico'] as $r): ?>
                                    <option value="<?= $r ?>" <?= old('tipoRol_per', $item['tipoRol_per']) === $r ? 'selected' : '' ?>><?= $r ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="especialidadMedica_per" class="form-label">Especialidad <span class="text-danger">*</span></label>
                            <select id="especialidadMedica_per" name="especialidadMedica_per" class="form-select" required>
                                <?php foreach (['Cardiología','Pediatría','Medicina General','Ginecología','Traumatología','Dermatología','Administración','Nutrición','Psicología'] as $e): ?>
                                    <option value="<?= $e ?>" <?= old('especialidadMedica_per', $item['especialidadMedica_per']) === $e ? 'selected' : '' ?>><?= $e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="horarioLaboral_per" class="form-label">Horario Laboral <span class="text-danger">*</span></label>
                            <input type="text" id="horarioLaboral_per" name="horarioLaboral_per" class="form-control" required
                                   value="<?= esc(old('horarioLaboral_per', $item['horarioLaboral_per'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="nivelDesempeno_per" class="form-label">Nivel Desempeño (%)</label>
                            <input type="number" id="nivelDesempeno_per" name="nivelDesempeno_per" class="form-control"
                                   min="0" max="100" step="0.1" required
                                   value="<?= old('nivelDesempeno_per', $item['nivelDesempeno_per']) ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-1"></i> Actualizar</button>
                        <a href="<?= base_url('personal') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
