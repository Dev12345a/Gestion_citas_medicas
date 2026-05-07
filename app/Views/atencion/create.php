<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-plus-circle me-2 text-danger"></i>Nuevo Plan de Atención</h4>
    <a href="<?= base_url('atencion') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-hand-holding-heart me-2"></i>Formulario de Plan</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('atencion/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tipoPlanAtencion_ate" class="form-label">Tipo de Plan <span class="text-danger">*</span></label>
                            <select id="tipoPlanAtencion_ate" name="tipoPlanAtencion_ate" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['General','Especializado','Preventivo','VIP','Empresarial'] as $t): ?>
                                    <option value="<?= $t ?>" <?= old('tipoPlanAtencion_ate') === $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="horarioDisponible_ate" class="form-label">Horario Disponible <span class="text-danger">*</span></label>
                            <input type="text" id="horarioDisponible_ate" name="horarioDisponible_ate" class="form-control" required
                                   placeholder="Ej: 08:00–12:00" value="<?= old('horarioDisponible_ate') ?>">
                        </div>
                        <div class="col-12">
                            <label for="promocionActiva_ate" class="form-label">Promoción Activa <span class="text-danger">*</span></label>
                            <input type="text" id="promocionActiva_ate" name="promocionActiva_ate" class="form-control" required
                                   placeholder="Ej: Descuento 10%" value="<?= old('promocionActiva_ate') ?>">
                        </div>
                        <div class="col-12">
                            <label for="nivelPersonalizacion_ate" class="form-label">Nivel de Personalización <span class="text-danger">*</span></label>
                            <input type="text" id="nivelPersonalizacion_ate" name="nivelPersonalizacion_ate" class="form-control" required
                                   placeholder="Ej: Prioridad alta" value="<?= old('nivelPersonalizacion_ate') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save me-1"></i> Guardar Plan</button>
                        <a href="<?= base_url('atencion') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
