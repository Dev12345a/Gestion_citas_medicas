<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Registrar Nuevo Paciente</h4>
</div>

<div class="row">
    <div class="col-md-12">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header"><strong>Formulario de Registro</strong></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('patients/store') ?>" novalidate>
                    <?= csrf_field() ?>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label">Código del Paciente *</label>
                            <input type="text" id="code" name="code" class="form-control"
                                   value="<?= old('code') ?>"
                                   placeholder="Ej: PAC-011" required>
                            <div class="form-text">Solo letras, números y guiones.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Género *</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="M" <?= old('gender') === 'M' ? 'selected' : '' ?>>Masculino</option>
                                <option value="F" <?= old('gender') === 'F' ? 'selected' : '' ?>>Femenino</option>
                                <option value="O" <?= old('gender') === 'O' ? 'selected' : '' ?>>Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Nombre(s) *</label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                   value="<?= old('first_name') ?>"
                                   pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+"
                                   title="Solo letras y espacios"
                                   placeholder="Solo letras" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Apellidos *</label>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                   value="<?= old('last_name') ?>"
                                   pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+"
                                   title="Solo letras y espacios"
                                   placeholder="Solo letras" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                   value="<?= old('date_of_birth') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="blood_type" class="form-label">Tipo de Sangre</label>
                            <select id="blood_type" name="blood_type" class="form-select">
                                <option value="Desconocido">Desconocido</option>
                                <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bt): ?>
                                    <option value="<?= $bt ?>" <?= old('blood_type') === $bt ? 'selected' : '' ?>>
                                        <?= $bt ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                   value="<?= old('phone') ?>"
                                   pattern="[0-9\+\-\s]+"
                                   title="Solo números"
                                   placeholder="Solo números">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="<?= old('email') ?>"
                                   placeholder="correo@ejemplo.com">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" id="address" name="address" class="form-control"
                               value="<?= old('address') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="allergies" class="form-label">Alergias</label>
                        <input type="text" id="allergies" name="allergies" class="form-control"
                               value="<?= old('allergies') ?>" placeholder="Ninguna / Penicilina / etc.">
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notas clínicas</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"
                                  placeholder="Observaciones adicionales"><?= old('notes') ?></textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" id="is_active" name="is_active" class="form-check-input"
                               value="1" <?= old('is_active', '1') ? 'checked' : '' ?>>
                        <label for="is_active" class="form-check-label">Paciente activo</label>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Paciente</button>
                    <a href="<?= base_url('patients') ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>

    </div>
</div>

<?php echo view('footer'); ?>