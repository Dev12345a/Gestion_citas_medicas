<?php include(APPPATH . 'Views/header.php'); ?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('patients') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-warning mb-0"><i class="fas fa-user-edit me-2"></i>Editar Paciente</h2>
            <p class="text-muted mb-0">Modifica la información del paciente</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="<?= base_url('patients/update/' . $patient['id']) ?>" method="post">

                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <h5 class="fw-semibold text-dark mb-3 pb-2 border-bottom"><i class="fas fa-id-card me-2 text-primary"></i>Datos Generales</h5>

                        <div class="mb-3">
                            <label for="code" class="form-label fw-semibold">Código <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="<?= esc($patient['code']) ?>" required maxlength="20">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label fw-semibold">Nombre(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="<?= esc($patient['first_name']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label fw-semibold">Apellido(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="<?= esc($patient['last_name']) ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label fw-semibold">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?= esc($patient['date_of_birth']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label fw-semibold">Género</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="M" <?= $patient['gender']==='M' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="F" <?= $patient['gender']==='F' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="O" <?= $patient['gender']==='O' ? 'selected' : '' ?>>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?= esc($patient['address'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="col-md-6">
                        <h5 class="fw-semibold text-dark mb-3 pb-2 border-bottom"><i class="fas fa-heartbeat me-2 text-danger"></i>Contacto y Datos Médicos</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= esc($patient['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" required
                                    value="<?= esc($patient['phone'] ?? '') ?>" maxlength="10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="blood_type" class="form-label fw-semibold">Tipo de Sangre</label>
                                <select class="form-control" id="blood_type" name="blood_type">
                                    <?php foreach(['Desconocido','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bt): ?>
                                        <option value="<?= $bt ?>" <?= ($patient['blood_type'] ?? 'Desconocido') === $bt ? 'selected' : '' ?>><?= $bt ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" <?= $patient['is_active'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-semibold" for="is_active">Paciente Activo</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="allergies" class="form-label fw-semibold">Alergias conocidas</label>
                            <textarea class="form-control" id="allergies" name="allergies" rows="2"><?= esc($patient['allergies'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Notas / Antecedentes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"><?= esc($patient['notes'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('patients/show/' . $patient['id']) ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-warning px-5">
                        <i class="fas fa-save me-2"></i>Actualizar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#phone').on('input', function() { $(this).val($(this).val().replace(/\D/g,'').substring(0,10)); });
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>