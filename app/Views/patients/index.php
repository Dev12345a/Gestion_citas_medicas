<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-users me-2 text-primary"></i>Gestión de Pacientes</h4>
    <a href="<?= base_url('patients/create') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Registrar Paciente
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead class="table-white">
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Historial Clínico</th>
                                <th>Categoría</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $p): ?>
                            <tr>
                                <td><?= $p['idPaciente_pac'] ?></td>
                                <td><strong><?= esc($p['nombreCompleto_pac']) ?></strong></td>
                                <td><?= esc($p['historialClinico_pac'] ?: '—') ?></td>
                                <td>
                                    <?php
                                    $cat = $p['categoriaPaciente_pac'];
                                    $badge = match($cat) {
                                        'Frecuente' => 'success',
                                        'Nuevo'     => 'primary',
                                        'VIP'       => 'warning',
                                        default     => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $badge ?>"><?= esc($cat) ?></span>
                                </td>
                                <td><?= esc($p['correoElectronico_pac'] ?: '—') ?></td>
                                <td><?= esc($p['telefono_pac'] ?: '—') ?></td>
                                <td><?= esc($p['direccion_pac'] ?: '—') ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('patients/edit/'.$p['idPaciente_pac']) ?>"
                                       class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $p['idPaciente_pac'] ?>"
                                            data-nombre="<?= esc($p['nombreCompleto_pac']) ?>"
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel"><i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar al paciente <strong id="nombrePaciente"></strong>? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnConfirmarEliminar" class="btn btn-danger"><i class="fas fa-trash me-1"></i>Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalEliminar');
    modal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;
        document.getElementById('nombrePaciente').textContent = btn.getAttribute('data-nombre');
        document.getElementById('btnConfirmarEliminar').href = '<?= base_url('patients/delete/') ?>' + btn.getAttribute('data-id');
    });
});
</script>

<?php echo view('footer'); ?>