<?php echo view('header'); ?>

<div class="page-header">
    <h4 class="page-title">Citas Médicas</h4>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <button class="btn btn-primary" disabled title="Módulo en construcción">
            Agendar Cita (En Construcción)
        </button>
        <span class="text-muted ms-2"><small>Esta función será implementada en la siguiente fase del proyecto.</small></span>
    </div>
</div>

<?php if (empty($appointments)): ?>
    <div class="alert alert-info">No hay citas registradas.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= esc($a['patient_first_name'] . ' ' . $a['patient_last_name']) ?></td>
                <td>Dr. <?= esc($a['doctor_first_name'] . ' ' . $a['doctor_last_name']) ?></td>
                <td><?= esc($a['appointment_date']) ?></td>
                <td><?= esc(substr($a['appointment_time'], 0, 5)) ?></td>
                <td><?= esc($a['reason']) ?></td>
                <td>
                    <?php
                    $statusLabels = [
                        'scheduled'  => ['label' => 'Programada',  'class' => 'bg-secondary'],
                        'confirmed'  => ['label' => 'Confirmada',  'class' => 'bg-primary'],
                        'completed'  => ['label' => 'Completada',  'class' => 'bg-success'],
                        'cancelled'  => ['label' => 'Cancelada',   'class' => 'bg-danger'],
                        'no_show'    => ['label' => 'No asistió',  'class' => 'bg-warning text-dark'],
                    ];
                    $s = $statusLabels[$a['status']] ?? ['label' => $a['status'], 'class' => 'bg-secondary'];
                    ?>
                    <span class="badge <?= $s['class'] ?>"><?= $s['label'] ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php echo view('footer'); ?>
