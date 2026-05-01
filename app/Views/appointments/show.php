<?php include(APPPATH . 'Views/header.php'); ?>

<?php
$statusLabel = ['scheduled'=>'Agendada','confirmed'=>'Confirmada','completed'=>'Completada','cancelled'=>'Cancelada','no_show'=>'No asistió'];
$statusClass = ['scheduled'=>'secondary','confirmed'=>'primary','completed'=>'success','cancelled'=>'danger','no_show'=>'warning'];
?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('appointments') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-info mb-0"><i class="fas fa-calendar-check me-2"></i>Detalle de Cita</h2>
            <p class="text-muted mb-0">Información completa y registro de seguimiento</p>
        </div>
        <?php if (!in_array($appointment['status'], ['completed','cancelled'])): ?>
        <div class="ms-auto d-flex gap-2">
            <a href="<?= base_url('appointments/edit/' . $appointment['id']) ?>" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Editar
            </a>
            <a href="<?= base_url('appointments/cancel/' . $appointment['id']) ?>" class="btn btn-danger btn-cancel">
                <i class="fas fa-times me-1"></i>Cancelar Cita
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <!-- Info de la cita -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header py-3" style="background:linear-gradient(135deg,#667eea,#764ba2);">
                    <h5 class="mb-0 text-white fw-bold"><i class="fas fa-info-circle me-2"></i>Información de la Cita</h5>
                </div>
                <div class="card-body">
                    <div class="text-center my-3">
                        <span class="badge badge-<?= $appointment['status'] ?> fs-6 px-3 py-2">
                            <?= $statusLabel[$appointment['status']] ?? $appointment['status'] ?>
                        </span>
                    </div>

                    <table class="table table-borderless">
                        <tr><td class="text-muted fw-semibold" style="width:40%"><i class="fas fa-calendar me-2"></i>Fecha</td>
                            <td><?= date('d/m/Y', strtotime($appointment['appointment_date'])) ?></td></tr>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-clock me-2"></i>Hora</td>
                            <td><?= substr($appointment['appointment_time'],0,5) ?></td></tr>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-user me-2"></i>Paciente</td>
                            <td><a href="<?= base_url('patients/show/' . $appointment['patient_id']) ?>" class="fw-semibold text-decoration-none">
                                <?= esc($appointment['patient_first_name'] . ' ' . $appointment['patient_last_name']) ?>
                            </a><br><small class="text-muted"><?= esc($appointment['patient_code']) ?></small></td></tr>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-phone me-2"></i>Contacto</td>
                            <td><?= esc($appointment['patient_phone'] ?? '—') ?></td></tr>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-user-md me-2"></i>Doctor</td>
                            <td>Dr(a). <?= esc($appointment['doctor_first_name'] . ' ' . $appointment['doctor_last_name']) ?>
                            <br><small class="text-muted"><?= esc($appointment['specialty_name']) ?></small></td></tr>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-clipboard me-2"></i>Motivo</td>
                            <td><?= esc($appointment['reason']) ?></td></tr>
                        <?php if ($appointment['notes']): ?>
                        <tr><td class="text-muted fw-semibold"><i class="fas fa-sticky-note me-2"></i>Notas</td>
                            <td><?= esc($appointment['notes']) ?></td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Seguimiento -->
        <div class="col-lg-7 mb-4">
            <?php if ($followUp): ?>
                <!-- Mostrar seguimiento existente -->
                <div class="card border-0 shadow-sm border-start border-success border-4">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-notes-medical me-2"></i>Registro de Seguimiento</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold text-muted small">Fecha de Consulta</label>
                                <p class="mb-0"><?= date('d/m/Y', strtotime($followUp['follow_up_date'])) ?></p>
                            </div>
                            <?php if ($followUp['next_appointment_date']): ?>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold text-muted small">Próxima Cita</label>
                                <p class="mb-0 text-primary fw-semibold"><?= date('d/m/Y', strtotime($followUp['next_appointment_date'])) ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 p-3 rounded" style="background:#f8f9fa;">
                            <label class="fw-semibold text-muted small d-block"><i class="fas fa-stethoscope me-1 text-primary"></i>Diagnóstico</label>
                            <p class="mb-0 fw-semibold"><?= esc($followUp['diagnosis']) ?></p>
                        </div>
                        <?php if ($followUp['treatment']): ?>
                        <div class="mb-3">
                            <label class="fw-semibold text-muted small d-block"><i class="fas fa-procedures me-1 text-info"></i>Tratamiento</label>
                            <p class="mb-0"><?= esc($followUp['treatment']) ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($followUp['prescription']): ?>
                        <div class="mb-3">
                            <label class="fw-semibold text-muted small d-block"><i class="fas fa-pills me-1 text-warning"></i>Prescripción</label>
                            <p class="mb-0"><?= esc($followUp['prescription']) ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($followUp['notes']): ?>
                        <div class="mb-0">
                            <label class="fw-semibold text-muted small d-block"><i class="fas fa-comment me-1"></i>Observaciones</label>
                            <p class="mb-0"><?= esc($followUp['notes']) ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif (!in_array($appointment['status'], ['cancelled'])): ?>
                <!-- Formulario para registrar seguimiento -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header py-3" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                        <h5 class="mb-0 text-white fw-bold"><i class="fas fa-plus-circle me-2"></i>Registrar Seguimiento</h5>
                        <small class="text-white-50">Completa la consulta registrando el diagnóstico y tratamiento</small>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('appointments/saveFollowUp/' . $appointment['id']) ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="follow_up_date" class="form-label fw-semibold">Fecha de Consulta <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="follow_up_date" name="follow_up_date"
                                        value="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="next_appointment_date" class="form-label fw-semibold">Próxima Cita</label>
                                    <input type="date" class="form-control" id="next_appointment_date" name="next_appointment_date">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="diagnosis" class="form-label fw-semibold">Diagnóstico <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="2" required
                                    placeholder="Diagnóstico clínico..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="treatment" class="form-label fw-semibold">Tratamiento</label>
                                <textarea class="form-control" id="treatment" name="treatment" rows="2"
                                    placeholder="Plan de tratamiento indicado..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="prescription" class="form-label fw-semibold">Prescripción / Medicamentos</label>
                                <textarea class="form-control" id="prescription" name="prescription" rows="2"
                                    placeholder="Medicamentos, dosis y frecuencia..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label fw-semibold">Observaciones</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2">
                                <i class="fas fa-check-circle me-2"></i>Guardar Seguimiento y Completar Cita
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5 text-muted">
                        <i class="fas fa-ban fa-3x mb-3 opacity-50 text-danger"></i>
                        <p>Esta cita fue cancelada y no tiene seguimiento registrado.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$('.btn-cancel').on('click', function(e) {
    e.preventDefault();
    if (confirm('¿Confirmas la cancelación de esta cita?')) window.location.href = $(this).attr('href');
});
</script>

<?php include(APPPATH . 'Views/footer.php'); ?>
