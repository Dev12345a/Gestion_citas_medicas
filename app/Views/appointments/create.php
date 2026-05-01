<?php include(APPPATH . 'Views/header.php'); ?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('appointments') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-primary mb-0"><i class="fas fa-calendar-plus me-2"></i>Agendar Nueva Cita</h2>
            <p class="text-muted mb-0">Registra una nueva cita médica</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="<?= base_url('appointments/store') ?>" method="post">
                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-user me-2 text-primary"></i>Datos de la Cita</h5>

                        <div class="mb-3">
                            <label for="patient_id" class="form-label fw-semibold">Paciente <span class="text-danger">*</span></label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="">Selecciona un paciente...</option>
                                <?php foreach ($patients as $p): ?>
                                    <option value="<?= $p['id'] ?>"
                                        <?= ($preselect_patient ?? '') == $p['id'] ? 'selected' : '' ?>>
                                        <?= esc($p['code'] . ' — ' . $p['first_name'] . ' ' . $p['last_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="specialty_id" class="form-label fw-semibold">Especialidad <span class="text-danger">*</span></label>
                            <select class="form-control" id="specialty_id" name="specialty_id" required>
                                <option value="">Selecciona especialidad...</option>
                                <?php foreach ($specialties as $sp): ?>
                                    <option value="<?= $sp['id'] ?>"><?= esc($sp['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="doctor_id" class="form-label fw-semibold">Doctor <span class="text-danger">*</span></label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required disabled>
                                <option value="">Primero selecciona una especialidad</option>
                            </select>
                            <div id="doctor_schedule" class="form-text text-success fw-semibold mt-1"></div>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3 pb-2 border-bottom"><i class="fas fa-clock me-2 text-success"></i>Fecha, Hora y Motivo</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="appointment_date" class="form-label fw-semibold">Fecha <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                                    min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="appointment_time" class="form-label fw-semibold">Hora <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="appointment_time" name="appointment_time"
                                    min="07:00" max="21:00" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label fw-semibold">Motivo de la cita <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="reason" name="reason" rows="4" required
                                placeholder="Describe brevemente el motivo de consulta..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Notas adicionales</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"
                                placeholder="Observaciones opcionales..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Estado inicial</label>
                            <select class="form-control" id="status" name="status">
                                <option value="scheduled">Agendada</option>
                                <option value="confirmed">Confirmada</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('appointments') ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i>Guardar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // AJAX: cargar doctores según especialidad
    $('#specialty_id').on('change', function() {
        const specId = $(this).val();
        const $doctorSelect = $('#doctor_id');
        const $schedule = $('#doctor_schedule');

        $doctorSelect.html('<option value="">Cargando...</option>').prop('disabled', true);
        $schedule.text('');

        if (!specId) {
            $doctorSelect.html('<option value="">Primero selecciona una especialidad</option>');
            return;
        }

        $.getJSON('<?= base_url('doctors/bySpecialty/') ?>' + specId, function(data) {
            if (data.length === 0) {
                $doctorSelect.html('<option value="">Sin doctores disponibles para esta especialidad</option>');
                return;
            }
            let opts = '<option value="">Selecciona un doctor...</option>';
            data.forEach(function(doc) {
                opts += `<option value="${doc.id}" data-schedule="${doc.schedule ?? ''}">
                    Dr(a). ${doc.first_name} ${doc.last_name} — ${doc.code}
                </option>`;
            });
            $doctorSelect.html(opts).prop('disabled', false);
        });
    });

    // Mostrar horario al seleccionar doctor
    $('#doctor_id').on('change', function() {
        const schedule = $('option:selected', this).data('schedule');
        $('#doctor_schedule').text(schedule ? '🕐 ' + schedule : '');
    });
});
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>
