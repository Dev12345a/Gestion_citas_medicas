<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Registrar Nuevo Paciente</h4>
</div>

<div class="row">
    <div class="col-md-8">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header"><strong>Formulario de Registro de Paciente</strong></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('patients/store') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nombreCompleto_pac" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                        <input type="text" id="nombreCompleto_pac" name="nombreCompleto_pac"
                               class="form-control"
                               value="<?= old('nombreCompleto_pac') ?>"
                               placeholder="Ej: Juan Pérez García"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="historialClinico_pac" class="form-label">Historial Clínico</label>
                        <input type="text" id="historialClinico_pac" name="historialClinico_pac"
                               class="form-control"
                               value="<?= old('historialClinico_pac') ?>"
                               placeholder="Ej: Hipertensión, Diabetes...">
                    </div>

                    <div class="mb-3">
                        <label for="categoriaPaciente_pac" class="form-label">Categoría del Paciente <span class="text-danger">*</span></label>
                        <select id="categoriaPaciente_pac" name="categoriaPaciente_pac" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            <option value="Nuevo"     <?= old('categoriaPaciente_pac') === 'Nuevo'     ? 'selected' : '' ?>>Nuevo</option>
                            <option value="Frecuente" <?= old('categoriaPaciente_pac') === 'Frecuente' ? 'selected' : '' ?>>Frecuente</option>
                            <option value="Ocasional" <?= old('categoriaPaciente_pac') === 'Ocasional' ? 'selected' : '' ?>>Ocasional</option>
                            <option value="VIP"       <?= old('categoriaPaciente_pac') === 'VIP'       ? 'selected' : '' ?>>VIP</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="correoElectronico_pac" class="form-label">Correo Electrónico</label>
                        <input type="email" id="correoElectronico_pac" name="correoElectronico_pac"
                               class="form-control"
                               value="<?= old('correoElectronico_pac') ?>"
                               placeholder="correo@ejemplo.com">
                    </div>

                    <div class="mb-3">
                        <label for="telefono_pac" class="form-label">Teléfono</label>
                        <input type="text" id="telefono_pac" name="telefono_pac"
                               class="form-control"
                               value="<?= old('telefono_pac') ?>"
                               placeholder="Ej: 0991234567">
                    </div>

                    <div class="mb-3">
                        <label for="direccion_pac" class="form-label">Dirección</label>
                        <input type="text" id="direccion_pac" name="direccion_pac"
                               class="form-control"
                               value="<?= old('direccion_pac') ?>"
                               placeholder="Ej: Calle Principal 10, Quito">
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Paciente
                    </button>
                    <a href="<?= base_url('patients') ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>

    </div>
</div>

<?php echo view('footer'); ?>