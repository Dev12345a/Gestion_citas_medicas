<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-user-plus me-2 text-primary"></i>Nuevo Personal Médico</h4>
    <a href="<?= base_url('personal') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-id-badge me-2"></i>Formulario de Registro</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('personal/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="idPersonal_per" class="form-label">ID Personal <span class="text-danger">*</span></label>
                            <input type="number" id="idPersonal_per" name="idPersonal_per" class="form-control" required
                                   placeholder="Ej: 25" value="<?= old('idPersonal_per') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tipoRol_per" class="form-label">Tipo de Rol <span class="text-danger">*</span></label>
                            <select id="tipoRol_per" name="tipoRol_per" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Médico','Administrativo','Enfermero','Técnico'] as $r): ?>
                                    <option value="<?= $r ?>" <?= old('tipoRol_per') === $r ? 'selected' : '' ?>><?= $r ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Credenciales de acceso (opcionales) -->
                        <div class="col-md-6">
                            <label for="username_per" class="form-label">Usuario de acceso</label>
                            <input type="text" id="username_per" name="username_per" class="form-control"
                                   placeholder="Ej: dr.nuevo" value="<?= old('username_per') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña inicial</label>
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="Mínimo 6 caracteres">
                        </div>
                        <div class="col-12">
                            <label for="especialidadMedica_per" class="form-label">Especialidad Médica <span class="text-danger">*</span></label>
                            <select id="especialidadMedica_per" name="especialidadMedica_per" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Cardiología','Pediatría','Medicina General','Ginecología','Traumatología','Dermatología','Administración','Nutrición','Psicología'] as $e): ?>
                                    <option value="<?= $e ?>" <?= old('especialidadMedica_per') === $e ? 'selected' : '' ?>><?= $e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="horarioLaboral_per" class="form-label">Horario Laboral <span class="text-danger">*</span></label>
                            <input type="text" id="horarioLaboral_per" name="horarioLaboral_per" class="form-control" required
                                   placeholder="Ej: 08:00–16:00" value="<?= old('horarioLaboral_per') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="nivelDesempeno_per" class="form-label">Nivel de Desempeño (%) <span class="text-danger">*</span></label>
                            <input type="number" id="nivelDesempeno_per" name="nivelDesempeno_per" class="form-control"
                                   min="0" max="100" step="0.1" required placeholder="95.0" value="<?= old('nivelDesempeno_per') ?>"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Guardar</button>
                        <a href="<?= base_url('personal') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
