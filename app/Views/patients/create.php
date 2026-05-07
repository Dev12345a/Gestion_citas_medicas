<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-user-plus me-2 text-primary"></i>Registrar Nuevo Paciente</h4>
    <a href="<?= base_url('patients') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Formulario de Registro de Paciente</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('patients/store') ?>">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="nombreCompleto_pac" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                            <input type="text" id="nombreCompleto_pac" name="nombreCompleto_pac"
                                   class="form-control" required minlength="3"
                                   value="<?= old('nombreCompleto_pac') ?>"
                                   placeholder="Ej: Juan Pérez García">
                        </div>
                        <div class="col-md-4">
                            <label for="categoriaPaciente_pac" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select id="categoriaPaciente_pac" name="categoriaPaciente_pac" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="Nuevo"     <?= old('categoriaPaciente_pac') === 'Nuevo'     ? 'selected' : '' ?>>Nuevo</option>
                                <option value="Frecuente" <?= old('categoriaPaciente_pac') === 'Frecuente' ? 'selected' : '' ?>>Frecuente</option>
                                <option value="Ocasional" <?= old('categoriaPaciente_pac') === 'Ocasional' ? 'selected' : '' ?>>Ocasional</option>
                                <option value="VIP"       <?= old('categoriaPaciente_pac') === 'VIP'       ? 'selected' : '' ?>>VIP</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="correoElectronico_pac" class="form-label">Correo Electrónico</label>
                            <input type="email" id="correoElectronico_pac" name="correoElectronico_pac"
                                   class="form-control"
                                   value="<?= old('correoElectronico_pac') ?>"
                                   placeholder="correo@ejemplo.com">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono_pac" class="form-label">Teléfono</label>
                            <input type="text" id="telefono_pac" name="telefono_pac"
                                   class="form-control"
                                   value="<?= old('telefono_pac') ?>"
                                   placeholder="Ej: 0991234567">
                        </div>
                        <div class="col-12">
                            <label for="direccion_pac" class="form-label">Dirección</label>
                            <input type="text" id="direccion_pac" name="direccion_pac"
                                   class="form-control"
                                   value="<?= old('direccion_pac') ?>"
                                   placeholder="Ej: Calle Principal 10, Quito">
                        </div>
                        <div class="col-12">
                            <label for="historialClinico_pac" class="form-label">Historial Clínico</label>
                            <textarea id="historialClinico_pac" name="historialClinico_pac"
                                      class="form-control" rows="3"
                                      placeholder="Ej: Hipertensión, Diabetes..."><?= old('historialClinico_pac') ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar Paciente
                        </button>
                        <a href="<?= base_url('patients') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo view('footer'); ?>