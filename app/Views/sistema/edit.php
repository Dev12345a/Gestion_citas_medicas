<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-user-edit me-2 text-warning"></i>Editar Usuario del Sistema</h4>
    <a href="<?= base_url('sistema') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Usuario: <?= esc($item['nombreUsuario_sis']) ?></h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sistema/update/'.$item['id']) ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombreUsuario_sis" class="form-label">Nombre de Usuario <span class="text-danger">*</span></label>
                            <input type="text" id="nombreUsuario_sis" name="nombreUsuario_sis" class="form-control" required
                                   value="<?= esc(old('nombreUsuario_sis', $item['nombreUsuario_sis'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="rolUsuario_sis" class="form-label">Rol de Usuario <span class="text-danger">*</span></label>
                            <select id="rolUsuario_sis" name="rolUsuario_sis" class="form-select" required>
                                <?php foreach (['administrador','médico','recepcionista','enfermero','paciente'] as $r): ?>
                                    <option value="<?= $r ?>" <?= old('rolUsuario_sis', $item['rolUsuario_sis']) === $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="motorBaseDatos_sis" class="form-label">Motor de Base de Datos</label>
                            <select id="motorBaseDatos_sis" name="motorBaseDatos_sis" class="form-select" required>
                                <?php foreach (['MySQL','PostgreSQL','SQL Server','MongoDB'] as $m): ?>
                                    <option value="<?= $m ?>" <?= old('motorBaseDatos_sis', $item['motorBaseDatos_sis']) === $m ? 'selected' : '' ?>><?= $m ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nivelSeguridad_sis" class="form-label">Nivel de Seguridad</label>
                            <select id="nivelSeguridad_sis" name="nivelSeguridad_sis" class="form-select" required>
                                <?php foreach (['Alta','Media','Baja'] as $n): ?>
                                    <option value="<?= $n ?>" <?= old('nivelSeguridad_sis', $item['nivelSeguridad_sis']) === $n ? 'selected' : '' ?>><?= $n ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoIntegracion_sis" class="form-label">Tipo de Integración</label>
                            <select id="tipoIntegracion_sis" name="tipoIntegracion_sis" class="form-select" required>
                                <?php foreach (['API externa','Sistema interno','Plataforma salud','Webhook'] as $t): ?>
                                    <option value="<?= $t ?>" <?= old('tipoIntegracion_sis', $item['tipoIntegracion_sis']) === $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="estadoUsuario_sis" class="form-label">Estado</label>
                            <select id="estadoUsuario_sis" name="estadoUsuario_sis" class="form-select" required>
                                <option value="Activo" <?= old('estadoUsuario_sis', $item['estadoUsuario_sis']) === 'Activo' ? 'selected' : '' ?>>Activo</option>
                                <option value="Inactivo" <?= old('estadoUsuario_sis', $item['estadoUsuario_sis']) === 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-1"></i> Actualizar</button>
                        <a href="<?= base_url('sistema') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
