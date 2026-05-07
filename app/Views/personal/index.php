<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-user-md me-2 text-purple"></i>Personal Médico</h4>
    <a href="<?= base_url('personal/create') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Nuevo Personal
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead class="table-white">
                            <tr>
                                <th>ID Médico</th>
                                <th>ID Personal</th>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Horario Laboral</th>
                                <th>Nivel Desempeño</th>
                                <th>Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['idMedico_per'] ?></td>
                                <td><?= $r['idPersonal_per'] ?></td>
                                <td><strong><?= esc($r['username_per']) ?></strong></td>
                                <td><strong><?= esc($r['especialidadMedica_per']) ?></strong></td>
                                <td><i class="fas fa-clock text-muted me-1"></i><?= esc($r['horarioLaboral_per']) ?></td>
                                <td>
                                    <?php $nivel = $r['nivelDesempeno_per']; ?>
                                    <span class="badge bg-<?= $nivel >= 90 ? 'success' : ($nivel >= 75 ? 'warning' : 'danger') ?>">
                                        <?= number_format($nivel, 1) ?>%
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $r['tipoRol_per'] === 'Médico' ? 'primary' : 'secondary' ?>">
                                        <?= esc($r['tipoRol_per']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('personal/edit/'.$r['idMedico_per']) ?>"
                                       class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['idMedico_per'] ?>"
                                            data-nombre="<?= esc($r['especialidadMedica_per']) ?>">
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

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Registro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">¿Eliminar el registro de <strong id="nombreItem"></strong>?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnConfirmar" class="btn btn-danger"><i class="fas fa-trash me-1"></i>Eliminar</a>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('modalEliminar').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    document.getElementById('nombreItem').textContent = btn.getAttribute('data-nombre');
    document.getElementById('btnConfirmar').href = '<?= base_url('personal/delete/') ?>' + btn.getAttribute('data-id');
});
</script>

<?php echo view('footer'); ?>
