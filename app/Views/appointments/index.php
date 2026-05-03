<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Citas Médicas</h4>
    <p class="text-muted">Vista de solo lectura</p>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <button class="btn btn-primary" disabled title="Módulo en construcción">
            <i class="fas fa-plus me-1"></i> Nueva Cita (Mantenimiento)
        </button>
        <span class="text-muted ms-2"><small>Esta función será implementada en la siguiente fase del proyecto.</small></span>
    </div>
</div>

<?php if (empty($appointments)): ?>
    <div class="alert alert-info">No hay citas registradas en el sistema.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead class="table-dark">
            <tr>
                <th>ID Cita</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Servicio Médico</th>
                <th>Estado</th>
                <th>Recordatorio</th>
                <th>Satisfacción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $a): ?>
            <tr>
                <td><?= esc($a['idCita_cit']) ?></td>
                <td><?= esc($a['fechaCita_cit']) ?></td>
                <td><?= esc($a['nombreCompleto_pac'] ?? '—') ?></td>
                <td><?= esc($a['nombreServicio_ser'] ?? '—') ?></td>
                <td>
                    <?php
                    $statusClass = match($a['estadoCita_cit']) {
                        'Atendida'  => 'bg-success',
                        'Pendiente' => 'bg-warning text-dark',
                        'Cancelada' => 'bg-danger',
                        default     => 'bg-secondary',
                    };
                    ?>
                    <span class="badge <?= $statusClass ?>"><?= esc($a['estadoCita_cit']) ?></span>
                </td>
                <td><?= esc($a['tipoRecordatorio_cit']) ?></td>
                <td><?= esc($a['nivelSatisfaccion_cit']) ?> / 5</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php echo view('footer'); ?>
