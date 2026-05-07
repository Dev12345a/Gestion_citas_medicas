<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-edit me-2 text-warning"></i>Editar Plan Estratégico</h4>
    <a href="<?= base_url('plan') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Plan Estratégico #<?= $item['id'] ?></h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('plan/update/'.$item['id']) ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="ObjetivoGeneral_pla" class="form-label">Objetivo General <span class="text-danger">*</span></label>
                            <input type="text" id="ObjetivoGeneral_pla" name="ObjetivoGeneral_pla" class="form-control" required
                                   value="<?= esc(old('ObjetivoGeneral_pla', $item['ObjetivoGeneral_pla'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="misionSistema_pla" class="form-label">Misión del Sistema <span class="text-danger">*</span></label>
                            <textarea id="misionSistema_pla" name="misionSistema_pla" class="form-control" rows="3" required><?= esc(old('misionSistema_pla', $item['misionSistema_pla'])) ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="visionSistema_pla" class="form-label">Visión del Sistema <span class="text-danger">*</span></label>
                            <textarea id="visionSistema_pla" name="visionSistema_pla" class="form-control" rows="3" required><?= esc(old('visionSistema_pla', $item['visionSistema_pla'])) ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="indicadorRendimiento_pla" class="form-label">Indicador KPI (%)</label>
                            <input type="number" id="indicadorRendimiento_pla" name="indicadorRendimiento_pla" class="form-control"
                                   step="0.01" min="0" max="100" required value="<?= old('indicadorRendimiento_pla', $item['indicadorRendimiento_pla']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="metaAnual_pla" class="form-label">Meta Anual</label>
                            <input type="number" id="metaAnual_pla" name="metaAnual_pla" class="form-control"
                                   min="1" required value="<?= old('metaAnual_pla', $item['metaAnual_pla']) ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-1"></i> Actualizar</button>
                        <a href="<?= base_url('plan') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
