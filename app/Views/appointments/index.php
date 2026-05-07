<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-calendar-check me-2 text-success"></i>Citas Médicas</h4>
    <?php if (session()->get('user_role') !== 'paciente'): ?>
        <a href="<?= base_url('appointments/create') ?>" class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i> Nueva Cita
        </a>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead class="table-white">
                            <tr>
                                <th>ID Cita</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Servicio</th>
                                <th>Estado</th>
                                <th>Recordatorio</th>
                                <th>Satisfacción</th>
                                <?php if (session()->get('user_role') !== 'paciente'): ?>
                                    <th class="text-center">Acciones</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $a): ?>
                                <tr>
                                    <td><code><?= esc($a['idCita_cit']) ?></code></td>
                                    <td><?= date('d/m/Y', strtotime($a['fechaCita_cit'])) ?></td>
                                    <td><?= substr($a['horaCita_cit'], 0, 5) ?></td>
                                    <td><?= esc($a['nombreCompleto_pac'] ?? '—') ?></td>
                                    <td><?= esc($a['nombreServicio_ser'] ?? '—') ?></td>
                                    <td>
                                        <?php
                                        $estado = $a['estadoCita_cit'];
                                        $badge = match ($estado) {
                                            'Pendiente' => 'warning',
                                            'Atendida' => 'success',
                                            'Cancelada' => 'danger',
                                            'Confirmada' => 'primary',
                                            default => 'secondary'
                                        };
                                        ?>
                                        <span class="badge bg-<?= $badge ?>"><?= esc($estado) ?></span>
                                    </td>
                                    <td><small><?= esc($a['tipoRecordatorio_cit']) ?></small></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="fas fa-star text-warning" style="font-size:.75rem"></i>
                                            <span><?= number_format($a['nivelSatisfaccion_cit'], 1) ?></span>
                                        </div>
                                    </td>
                                    <?php if (session()->get('user_role') !== 'paciente'): ?>
                                        <td class="text-center">
                                            <a href="<?= base_url('appointments/edit/' . urlencode($a['idCita_cit'])) ?>"
                                                class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($a['estadoCita_cit'] !== 'Cancelada'): ?>
                                                <a href="<?= base_url('appointments/cancel/' . urlencode($a['idCita_cit'])) ?>"
                                                    class="btn btn-sm btn-outline-secondary ms-1"
                                                    onclick="return confirm('¿Cancelar esta cita?')" title="Cancelar">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                                data-bs-toggle="modal" data-bs-target="#modalEliminarCita"
                                                data-id="<?= esc($a['idCita_cit']) ?>"
                                                data-nombre="<?= esc($a['idCita_cit']) ?>" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Cita -->
<div class="modal fade" id="modalEliminarCita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Cita</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar la cita <strong id="nombreCita"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnConfirmarEliminarCita" class="btn btn-danger"><i
                        class="fas fa-trash me-1"></i>Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalEliminarCita');
        modal.addEventListener('show.bs.modal', function (e) {
            const btn = e.relatedTarget;
            document.getElementById('nombreCita').textContent = btn.getAttribute('data-nombre');
            document.getElementById('btnConfirmarEliminarCita').href =
                '<?= base_url('appointments/delete/') ?>' + encodeURIComponent(btn.getAttribute('data-id'));
        });
    });
</script>

<?php echo view('footer'); ?>