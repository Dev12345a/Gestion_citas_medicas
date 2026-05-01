<?php include(APPPATH . 'Views/header.php'); ?>

<?php
$statusLabel = ['scheduled'=>'Agendada','confirmed'=>'Confirmada','completed'=>'Completada','cancelled'=>'Cancelada','no_show'=>'No asistió'];
?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('appointments') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-warning mb-0"><i class="fas fa-calendar-edit me-2"></i>Editar Cita</h2>
            <p class="text-muted mb-0">Modifica los datos de la cita médica</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="<?= base_url('appointments/update/' . $appointment['id']) ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-user me-2 text-primary"></i>Datos de la Cita</h5>

                        <div class="mb-3">
                            <label for="patient_id" class="form-label fw-semibold">Paciente <span class="text-danger">*</span></label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <?php foreach ($patients as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= $appointment['patient_id'] == $p['id'] ? 'selected' : '' ?>>
                                        <?= esc($p['code'] . ' — ' . $p['first_name'] . ' ' . $p['last_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="specialty_id" class="form-label fw-semibold">Especialidad <span class="text-danger">*</span></label>
                            <select class="form-control" id="specialty_id" name="specialty_id" required>
                                <?php foreach ($specialties as $sp): ?>
                                    <option value="<?= $sp['id'] ?>" <?= $appointment['specialty_id'] == $sp['id'] ? 'selected' : '' ?>>
                                        <?= esc($sp['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label fw-semibold">Doctor <span class="text-danger">*</span></label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <?php foreach ($doctors as $doc): ?>
                                    <option value="<?= $doc['id'] ?>" <?= $appointment['doctor_id'] == $doc['id'] ? 'selected' : '' ?>>
                                        Dr(a). <?= esc($doc['first_name'] . ' ' . $doc['last_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-clock me-2 text-success"></i>Fecha, Hora y Estado</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="appointment_date" class="form-label fw-semibold">Fecha <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                                    value="<?= esc($appointment['appointment_date']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="appointment_time" class="form-label fw-semibold">Hora <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="appointment_time" name="appointment_time"
                                    value="<?= substr($appointment['appointment_time'],0,5) ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Estado</label>
                            <select class="form-control" id="status" name="status">
                                <?php foreach ($statusLabel as $val => $lbl): ?>
                                    <option value="<?= $val ?>" <?= $appointment['status'] === $val ? 'selected' : '' ?>><?= $lbl ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label fw-semibold">Motivo <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" required><?= esc($appointment['reason']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Notas</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"><?= esc($appointment['notes'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('appointments/show/' . $appointment['id']) ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-warning px-5"><i class="fas fa-save me-2"></i>Actualizar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Recargar doctores si cambia la especialidad
$('#specialty_id').on('change', function() {
    const specId = $(this).val();
    const currentDoctorId = <?= $appointment['doctor_id'] ?>;
    if (!specId) return;
    $.getJSON('<?= base_url('doctors/bySpecialty/') ?>' + specId, function(data) {
        let opts = '';
        data.forEach(function(doc) {
            const sel = doc.id == currentDoctorId ? 'selected' : '';
            opts += `<option value="${doc.id}" ${sel}>Dr(a). ${doc.first_name} ${doc.last_name}</option>`;
        });
        $('#doctor_id').html(opts || '<option value="">Sin doctores</option>');
    });
});
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>
