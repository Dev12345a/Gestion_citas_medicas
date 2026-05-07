<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-bullseye me-2 text-success"></i>Plan Estratégico</h4>
    <a href="<?= base_url('plan/create') ?>" class="btn btn-success btn-sm">
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
                                <th>Objetivo General</th>
                                <th>Misión</th>
                                <th>Visión</th>
                                <th>KPI (%)</th>
                                <th>Meta Anual</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><?= esc($r['ObjetivoGeneral_pla']) ?></td>
                                <td><small><?= esc($r['misionSistema_pla']) ?></small></td>
                                <td><small><?= esc($r['visionSistema_pla']) ?></small></td>
                                <td>
                                    <?php $kpi = $r['indicadorRendimiento_pla']; ?>
                                    <span class="badge bg-<?= $kpi >= 90 ? 'success' : ($kpi >= 75 ? 'warning' : 'danger') ?>">
                                        <?= number_format($kpi, 2) ?>%
                                    </span>
                                </td>
                                <td><?= $r['metaAnual_pla'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('plan/edit/'.$r['id']) ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['id'] ?>" data-nombre="Plan #<?= $r['id'] ?>">
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
            <div class="modal-body">¿Eliminar <strong id="nombreItem"></strong>?</div>
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
    document.getElementById('btnConfirmar').href = '<?= base_url('plan/delete/') ?>' + btn.getAttribute('data-id');
});
</script>
<?php echo view('footer'); ?>
