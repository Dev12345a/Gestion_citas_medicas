<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-calendar-plus me-2 text-success"></i>Nueva Cita Médica</h4>
    <a href="<?= base_url('appointments') ?>" class="btn btn-secondary btn-sm">
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
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Formulario de Nueva Cita</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('appointments/store') ?>">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="idCita_cit" class="form-label">ID de Cita <span class="text-danger">*</span></label>
                            <input type="text" id="idCita_cit" name="idCita_cit" class="form-control" required
                                   placeholder="Ej: Cita #004" value="<?= old('idCita_cit') ?>">
                            <small class="text-muted">Debe ser único en el sistema.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="fechaCita_cit" class="form-label">Fecha de Cita <span class="text-danger">*</span></label>
                            <input type="date" id="fechaCita_cit" name="fechaCita_cit" class="form-control" required
                                   value="<?= old('fechaCita_cit') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="idPaciente_cit" class="form-label">Paciente <span class="text-danger">*</span></label>
                            <select id="idPaciente_cit" name="idPaciente_cit" class="form-select" required>
                                <option value="">-- Seleccionar Paciente --</option>
                                <?php foreach ($patients as $p): ?>
                                    <option value="<?= $p['idPaciente_pac'] ?>"
                                        <?= old('idPaciente_cit') == $p['idPaciente_pac'] ? 'selected' : '' ?>>
                                        <?= esc($p['nombreCompleto_pac']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="idServicio_cit" class="form-label">Servicio Médico <span class="text-danger">*</span></label>
                            <select id="idServicio_cit" name="idServicio_cit" class="form-select" required>
                                <option value="">-- Seleccionar Servicio --</option>
                                <?php foreach ($servicios as $s): ?>
                                    <option value="<?= $s['idServicio_ser'] ?>"
                                        <?= old('idServicio_cit') == $s['idServicio_ser'] ? 'selected' : '' ?>>
                                        <?= esc($s['nombreServicio_ser']) ?> ($<?= number_format($s['precioConsulta_ser'], 2) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="estadoCita_cit" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select id="estadoCita_cit" name="estadoCita_cit" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Pendiente','Confirmada','Atendida','Cancelada','No Asistió'] as $e): ?>
                                    <option value="<?= $e ?>" <?= old('estadoCita_cit') === $e ? 'selected' : '' ?>><?= $e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoRecordatorio_cit" class="form-label">Tipo de Recordatorio <span class="text-danger">*</span></label>
                            <select id="tipoRecordatorio_cit" name="tipoRecordatorio_cit" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['SMS','Email','WhatsApp','Notificación App'] as $t): ?>
                                    <option value="<?= $t ?>" <?= old('tipoRecordatorio_cit') === $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nivelSatisfaccion_cit" class="form-label">Nivel de Satisfacción <span class="text-danger">*</span></label>
                            <input type="number" id="nivelSatisfaccion_cit" name="nivelSatisfaccion_cit"
                                   class="form-control" min="1" max="5" step="0.1" required
                                   placeholder="1.0 - 5.0" value="<?= old('nivelSatisfaccion_cit', '5.0') ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Guardar Cita
                        </button>
                        <a href="<?= base_url('appointments') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo view('footer'); ?>
