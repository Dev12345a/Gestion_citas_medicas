<?php echo view('header'); ?>
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-chart-line me-2 text-warning"></i>Nuevo Análisis de Mercado</h4>
    <a href="<?= base_url('analisis') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Formulario de Análisis</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('analisis/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fechaAnalisis_ana" class="form-label">Fecha de Análisis <span class="text-danger">*</span></label>
                            <input type="date" id="fechaAnalisis_ana" name="fechaAnalisis_ana" class="form-control" required value="<?= old('fechaAnalisis_ana', date('Y-m-d')) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="nivelDemanda_ana" class="form-label">Nivel de Demanda <span class="text-danger">*</span></label>
                            <select id="nivelDemanda_ana" name="nivelDemanda_ana" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Alta','Media','Baja'] as $n): ?><option value="<?= $n ?>" <?= old('nivelDemanda_ana') === $n ? 'selected' : '' ?>><?= $n ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nivelCompetencia_ana" class="form-label">Nivel de Competencia <span class="text-danger">*</span></label>
                            <select id="nivelCompetencia_ana" name="nivelCompetencia_ana" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Alta','Media','Baja'] as $n): ?><option value="<?= $n ?>" <?= old('nivelCompetencia_ana') === $n ? 'selected' : '' ?>><?= $n ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tendenciaSalud_ana" class="form-label">Tendencia en Salud <span class="text-danger">*</span></label>
                            <input type="text" id="tendenciaSalud_ana" name="tendenciaSalud_ana" class="form-control" required
                                   placeholder="Ej: Telemedicina" value="<?= old('tendenciaSalud_ana') ?>">
                        </div>
                        <div class="col-12">
                            <label for="normativaVigente_ana" class="form-label">Normativa Vigente <span class="text-danger">*</span></label>
                            <input type="text" id="normativaVigente_ana" name="normativaVigente_ana" class="form-control" required
                                   placeholder="Ej: Ley de Salud" value="<?= old('normativaVigente_ana') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save me-1"></i> Guardar Análisis</button>
                        <a href="<?= base_url('analisis') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo view('footer'); ?>
