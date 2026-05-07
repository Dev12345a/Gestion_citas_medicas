<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-stethoscope me-2 text-info"></i>Servicios Médicos</h4>
    <a href="<?= base_url('servicios/create') ?>" class="btn btn-info btn-sm text-white">
        <i class="fas fa-plus me-1"></i> Nuevo Servicio
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
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Rentabilidad %</th>
                                <th>Paquete</th>
                                <th>Duración (min)</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['idServicio_ser'] ?></td>
                                <td><strong><?= esc($r['nombreServicio_ser']) ?></strong></td>
                                <td>
                                    <span class="badge bg-<?= $r['estadoServicio_ser'] === 'Disponible' ? 'success' : 'danger' ?>">
                                        <?= esc($r['estadoServicio_ser']) ?>
                                    </span>
                                </td>
                                <td>$<?= number_format($r['precioConsulta_ser'], 2) ?></td>
                                <td><?= number_format($r['porcentajeRentabilidad_ser'], 2) ?>%</td>
                                <td><span class="badge bg-secondary"><?= esc($r['tipoPaquete_ser']) ?></span></td>
                                <td><?= $r['duracionServicio_ser'] ?> min</td>
                                <td class="text-center">
                                    <a href="<?= base_url('servicios/edit/'.$r['idServicio_ser']) ?>"
                                       class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['idServicio_ser'] ?>"
                                            data-nombre="<?= esc($r['nombreServicio_ser']) ?>">
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
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Servicio</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">¿Eliminar el servicio <strong id="nombreItem"></strong>?</div>
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
    document.getElementById('btnConfirmar').href = '<?= base_url('servicios/delete/') ?>' + btn.getAttribute('data-id');
});
</script>

<?php echo view('footer'); ?>
