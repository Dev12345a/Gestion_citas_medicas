<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-bullseye me-2 text-success"></i>Nuevo Plan Estratégico</h4>
    <a href="<?= base_url('plan') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Formulario de Plan Estratégico</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('plan/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="ObjetivoGeneral_pla" class="form-label">Objetivo General <span class="text-danger">*</span></label>
                            <input type="text" id="ObjetivoGeneral_pla" name="ObjetivoGeneral_pla" class="form-control" required
                                   placeholder="Ej: Reducir tiempo de espera" value="<?= old('ObjetivoGeneral_pla') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="misionSistema_pla" class="form-label">Misión del Sistema <span class="text-danger">*</span></label>
                            <textarea id="misionSistema_pla" name="misionSistema_pla" class="form-control" rows="3" required
                                      placeholder="Descripción de la misión..."><?= old('misionSistema_pla') ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="visionSistema_pla" class="form-label">Visión del Sistema <span class="text-danger">*</span></label>
                            <textarea id="visionSistema_pla" name="visionSistema_pla" class="form-control" rows="3" required
                                      placeholder="Descripción de la visión..."><?= old('visionSistema_pla') ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="indicadorRendimiento_pla" class="form-label">Indicador KPI (%) <span class="text-danger">*</span></label>
                            <input type="number" id="indicadorRendimiento_pla" name="indicadorRendimiento_pla" class="form-control"
                                   step="0.01" min="0" max="100" required placeholder="92.50" value="<?= old('indicadorRendimiento_pla') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="metaAnual_pla" class="form-label">Meta Anual <span class="text-danger">*</span></label>
                            <input type="number" id="metaAnual_pla" name="metaAnual_pla" class="form-control"
                                   min="1" required placeholder="50" value="<?= old('metaAnual_pla') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Guardar Plan</button>
                        <a href="<?= base_url('plan') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
