<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-hand-holding-heart me-2 text-danger"></i>Planes de Atención</h4>
    <a href="<?= base_url('atencion/create') ?>" class="btn btn-danger btn-sm">
        <i class="fas fa-plus me-1"></i> Nuevo Plan
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
                                <th>#</th>
                                <th>Tipo de Plan</th>
                                <th>Horario Disponible</th>
                                <th>Promoción Activa</th>
                                <th>Nivel Personalización</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><strong><?= esc($r['tipoPlanAtencion_ate']) ?></strong></td>
                                <td><i class="fas fa-clock text-muted me-1"></i><?= esc($r['horarioDisponible_ate']) ?></td>
                                <td><span class="badge bg-success"><?= esc($r['promocionActiva_ate']) ?></span></td>
                                <td><?= esc($r['nivelPersonalizacion_ate']) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('atencion/edit/'.$r['id']) ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['id'] ?>" data-nombre="<?= esc($r['tipoPlanAtencion_ate']) ?>">
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
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Plan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">¿Eliminar el plan <strong id="nombreItem"></strong>?</div>
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
    document.getElementById('btnConfirmar').href = '<?= base_url('atencion/delete/') ?>' + btn.getAttribute('data-id');
});
</script>
<?php echo view('footer'); ?>
