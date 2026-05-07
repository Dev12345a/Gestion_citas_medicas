<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-chart-bar me-2 text-warning"></i>Análisis de Mercado</h4>
    <a href="<?= base_url('analisis/create') ?>" class="btn btn-warning btn-sm text-white">
        <i class="fas fa-plus me-1"></i> Nuevo Análisis
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
                                <th>Fecha Análisis</th>
                                <th>Nivel Demanda</th>
                                <th>Nivel Competencia</th>
                                <th>Tendencia Salud</th>
                                <th>Normativa Vigente</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><?= date('d/m/Y', strtotime($r['fechaAnalisis_ana'])) ?></td>
                                <td><span class="badge bg-<?= $r['nivelDemanda_ana'] === 'Alta' ? 'success' : ($r['nivelDemanda_ana'] === 'Media' ? 'warning' : 'danger') ?>"><?= esc($r['nivelDemanda_ana']) ?></span></td>
                                <td><span class="badge bg-<?= $r['nivelCompetencia_ana'] === 'Alta' ? 'danger' : ($r['nivelCompetencia_ana'] === 'Media' ? 'warning' : 'success') ?>"><?= esc($r['nivelCompetencia_ana']) ?></span></td>
                                <td><?= esc($r['tendenciaSalud_ana']) ?></td>
                                <td><?= esc($r['normativaVigente_ana']) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('analisis/edit/'.$r['id']) ?>" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['id'] ?>" data-nombre="Análisis #<?= $r['id'] ?>">
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
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Análisis</h5>
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
    document.getElementById('btnConfirmar').href = '<?= base_url('analisis/delete/') ?>' + btn.getAttribute('data-id');
});
</script>
<?php echo view('footer'); ?>
