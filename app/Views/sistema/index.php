<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="page-title mb-0"><i class="fas fa-cog me-2 text-secondary"></i>Usuarios del Sistema</h4>
    <a href="<?= base_url('sistema/create') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-plus me-1"></i> Nuevo Usuario
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
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Motor BD</th>
                                <th>Seguridad</th>
                                <th>Integración</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $r): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><strong><i class="fas fa-user me-1 text-muted"></i><?= esc($r['nombreUsuario_sis']) ?></strong></td>
                                <td><span class="badge bg-primary"><?= esc($r['rolUsuario_sis']) ?></span></td>
                                <td><?= esc($r['motorBaseDatos_sis']) ?></td>
                                <td><span class="badge bg-<?= $r['nivelSeguridad_sis'] === 'Alta' ? 'success' : ($r['nivelSeguridad_sis'] === 'Media' ? 'warning' : 'danger') ?>"><?= esc($r['nivelSeguridad_sis']) ?></span></td>
                                <td><small><?= esc($r['tipoIntegracion_sis']) ?></small></td>
                                <td><span class="badge bg-<?= $r['estadoUsuario_sis'] === 'Activo' ? 'success' : 'danger' ?>"><?= esc($r['estadoUsuario_sis']) ?></span></td>
                                <td class="text-center">
                                    <a href="<?= base_url('sistema/edit/'.$r['id']) ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="<?= $r['id'] ?>" data-nombre="<?= esc($r['nombreUsuario_sis']) ?>">
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
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">¿Eliminar el usuario <strong id="nombreItem"></strong> del sistema?</div>
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
    document.getElementById('btnConfirmar').href = '<?= base_url('sistema/delete/') ?>' + btn.getAttribute('data-id');
});
</script>
<?php echo view('footer'); ?>
