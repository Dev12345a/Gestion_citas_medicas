<?php include(APPPATH . 'Views/header.php'); ?>

<?php
$genderLabel = ['M' => 'Masculino', 'F' => 'Femenino', 'O' => 'Otro'];
$statusLabel = ['scheduled'=>'Agendada','confirmed'=>'Confirmada','completed'=>'Completada','cancelled'=>'Cancelada','no_show'=>'No asistió'];
$statusClass = ['scheduled'=>'secondary','confirmed'=>'primary','completed'=>'success','cancelled'=>'danger','no_show'=>'warning'];
?>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('patients') ?>" class="btn btn-outline-secondary me-3"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold text-info mb-0"><i class="fas fa-user-circle me-2"></i>Perfil del Paciente</h2>
            <p class="text-muted mb-0">Información clínica e historial de citas</p>
        </div>
        <div class="ms-auto d-flex gap-2">
            <a href="<?= base_url('appointments/create?patient_id=' . $patient['id']) ?>" class="btn btn-success">
                <i class="fas fa-calendar-plus me-2"></i>Nueva Cita
            </a>
            <a href="<?= base_url('patients/edit/' . $patient['id']) ?>" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Tarjeta de datos del paciente -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;margin:0 auto;">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                    <h4 class="fw-bold"><?= esc($patient['first_name'] . ' ' . $patient['last_name']) ?></h4>
                    <span class="badge bg-info mb-3"><?= esc($patient['code']) ?></span>

                    <div class="text-start mt-3">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-venus-mars me-2"></i>Género</span>
                            <strong><?= $genderLabel[$patient['gender']] ?? '—' ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-birthday-cake me-2"></i>Nacimiento</span>
                            <strong><?= $patient['date_of_birth'] ? date('d/m/Y', strtotime($patient['date_of_birth'])) : '—' ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-tint me-2"></i>Sangre</span>
                            <strong><?= esc($patient['blood_type'] ?? 'Desconocido') ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-phone me-2"></i>Teléfono</span>
                            <strong><?= esc($patient['phone'] ?? '—') ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-envelope me-2"></i>Email</span>
                            <strong><?= esc($patient['email'] ?? '—') ?></strong>
                        </div>
                        <div class="py-2 border-bottom">
                            <div class="text-muted mb-1"><i class="fas fa-map-marker-alt me-2"></i>Dirección</div>
                            <div><?= esc($patient['address'] ?? '—') ?></div>
                        </div>
                        <?php if ($patient['allergies']): ?>
                        <div class="py-2 border-bottom">
                            <div class="text-muted mb-1"><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Alergias</div>
                            <div class="text-danger fw-semibold"><?= esc($patient['allergies']) ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if ($patient['notes']): ?>
                        <div class="py-2">
                            <div class="text-muted mb-1"><i class="fas fa-notes-medical me-2"></i>Antecedentes</div>
                            <div><?= esc($patient['notes']) ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial de citas -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-calendar-alt me-2 text-primary"></i>Historial de Citas (<?= count($appointments) ?>)</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($appointments)): ?>
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3 opacity-50"></i>
                            <p>No hay citas registradas para este paciente.</p>
                            <a href="<?= base_url('appointments/create?patient_id=' . $patient['id']) ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Agendar Primera Cita
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($appointments as $apt): ?>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold"><?= date('d/m/Y', strtotime($apt['appointment_date'])) ?></div>
                                                <small class="text-muted"><?= substr($apt['appointment_time'], 0, 5) ?></small>
                                            </td>
                                            <td>Dr(a). <?= esc($apt['doctor_first_name'] . ' ' . $apt['doctor_last_name']) ?></td>
                                            <td><?= esc($apt['specialty_name']) ?></td>
                                            <td>
                                                <span class="badge badge-<?= $apt['status'] ?>">
                                                    <?= $statusLabel[$apt['status']] ?? $apt['status'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('appointments/show/' . $apt['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Últimos seguimientos -->
            <?php if (!empty($followUps)): ?>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-notes-medical me-2 text-success"></i>Últimos Seguimientos</h5>
                </div>
                <div class="card-body">
                    <?php foreach (array_slice($followUps, 0, 3) as $fu): ?>
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <strong><?= date('d/m/Y', strtotime($fu['follow_up_date'])) ?></strong>
                                <span class="text-muted small">Dr(a). <?= esc($fu['doctor_first_name'] . ' ' . $fu['doctor_last_name']) ?> — <?= esc($fu['specialty_name']) ?></span>
                            </div>
                            <p class="mb-1"><i class="fas fa-stethoscope me-1 text-primary"></i><strong>Diagnóstico:</strong> <?= esc($fu['diagnosis']) ?></p>
                            <?php if ($fu['treatment']): ?>
                                <p class="mb-1 text-muted small"><i class="fas fa-pills me-1"></i><?= esc($fu['treatment']) ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include(APPPATH . 'Views/footer.php'); ?>
