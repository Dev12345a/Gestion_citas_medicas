<?php include(APPPATH . 'Views/header.php'); ?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('doctors') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-warning mb-0"><i class="fas fa-user-edit me-2"></i>Editar Doctor</h2>
            <p class="text-muted mb-0">Modifica la información del médico</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="<?= base_url('doctors/update/' . $doctor['id']) ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-id-badge me-2 text-primary"></i>Información del Doctor</h5>

                        <div class="mb-3">
                            <label for="specialty_id" class="form-label fw-semibold">Especialidad <span class="text-danger">*</span></label>
                            <select class="form-control" id="specialty_id" name="specialty_id" required>
                                <?php foreach ($specialties as $sp): ?>
                                    <option value="<?= $sp['id'] ?>" <?= $doctor['specialty_id'] == $sp['id'] ? 'selected' : '' ?>>
                                        <?= esc($sp['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label fw-semibold">Código <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="code" name="code" required
                                value="<?= esc($doctor['code']) ?>" maxlength="20">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label fw-semibold">Nombre(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required
                                    value="<?= esc($doctor['first_name']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label fw-semibold">Apellido(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required
                                    value="<?= esc($doctor['last_name']) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-phone me-2 text-success"></i>Contacto y Horario</h5>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($doctor['email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?= esc($doctor['phone'] ?? '') ?>" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="schedule" class="form-label fw-semibold">Horario de Atención</label>
                            <textarea class="form-control" id="schedule" name="schedule" rows="2"><?= esc($doctor['schedule'] ?? '') ?></textarea>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                value="1" <?= $doctor['is_active'] ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="is_active">Doctor Activo</label>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('doctors') ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-warning px-5"><i class="fas fa-save me-2"></i>Actualizar Doctor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#phone').on('input', function() { $(this).val($(this).val().replace(/\D/g,'').substring(0,10)); });
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>
