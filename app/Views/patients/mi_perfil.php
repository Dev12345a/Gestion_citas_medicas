<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-id-card me-2 text-success"></i>Mi Perfil</h4>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>

        <!-- Info tarjeta -->
        <div class="card mb-3" style="background:linear-gradient(135deg,#0f2027,#2c5364);border:none;color:#fff">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div style="width:72px;height:72px;background:linear-gradient(135deg,#00d2ff,#3a7bd5);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;flex-shrink:0">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold"><?= esc($patient['nombreCompleto_pac']) ?></h4>
                    <span class="badge bg-success mt-1"><?= esc($patient['categoriaPaciente_pac']) ?></span>
                    <p class="mb-0 mt-1 opacity-75 small"><?= esc($patient['correoElectronico_pac'] ?: 'Sin correo registrado') ?></p>
                </div>
            </div>
        </div>

        <!-- Historial -->
        <?php if ($patient['historialClinico_pac']): ?>
        <div class="alert alert-info mb-3">
            <i class="fas fa-file-medical me-2"></i><strong>Historial Clínico:</strong>
            <?= esc($patient['historialClinico_pac']) ?>
        </div>
        <?php endif; ?>

        <!-- Formulario edición -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-edit me-2"></i>Editar mi Información</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('mi-perfil/update') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" value="<?= esc($patient['nombreCompleto_pac']) ?>" disabled>
                            <small class="text-muted">Contacta a tu médico para cambiar tu nombre.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="correoElectronico_pac" class="form-label">Correo Electrónico</label>
                            <input type="email" id="correoElectronico_pac" name="correoElectronico_pac" class="form-control"
                                   value="<?= esc(old('correoElectronico_pac', $patient['correoElectronico_pac'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono_pac" class="form-label">Teléfono</label>
                            <input type="text" id="telefono_pac" name="telefono_pac" class="form-control"
                                   value="<?= esc(old('telefono_pac', $patient['telefono_pac'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="direccion_pac" class="form-label">Dirección</label>
                            <input type="text" id="direccion_pac" name="direccion_pac" class="form-control"
                                   value="<?= esc(old('direccion_pac', $patient['direccion_pac'])) ?>">
                        </div>
                        <div class="col-12">
                            <label for="historialClinico_pac" class="form-label">Observaciones personales</label>
                            <textarea id="historialClinico_pac" name="historialClinico_pac" class="form-control" rows="3"><?= esc(old('historialClinico_pac', $patient['historialClinico_pac'])) ?></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php echo view('footer'); ?>
