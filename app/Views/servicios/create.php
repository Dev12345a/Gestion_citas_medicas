<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-plus-circle me-2 text-info"></i>Nuevo Servicio Médico</h4>
    <a href="<?= base_url('servicios') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-stethoscope me-2"></i>Formulario de Servicio</h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('servicios/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nombreServicio_ser" class="form-label">Nombre del Servicio <span class="text-danger">*</span></label>
                            <input type="text" id="nombreServicio_ser" name="nombreServicio_ser" class="form-control" required
                                   placeholder="Ej: Consulta de Cardiología" value="<?= old('nombreServicio_ser') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="estadoServicio_ser" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select id="estadoServicio_ser" name="estadoServicio_ser" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="Disponible" <?= old('estadoServicio_ser') === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                                <option value="NoDisponible" <?= old('estadoServicio_ser') === 'NoDisponible' ? 'selected' : '' ?>>No Disponible</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoPaquete_ser" class="form-label">Tipo de Paquete <span class="text-danger">*</span></label>
                            <select id="tipoPaquete_ser" name="tipoPaquete_ser" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach (['Básico','Premium','Virtual','Familiar','Ejecutivo'] as $t): ?>
                                    <option value="<?= $t ?>" <?= old('tipoPaquete_ser') === $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="precioConsulta_ser" class="form-label">Precio ($) <span class="text-danger">*</span></label>
                            <input type="number" id="precioConsulta_ser" name="precioConsulta_ser" class="form-control"
                                   step="0.01" min="0" required placeholder="25.00" value="<?= old('precioConsulta_ser') ?>"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                        </div>
                        <div class="col-md-4">
                            <label for="porcentajeRentabilidad_ser" class="form-label">Rentabilidad (%) <span class="text-danger">*</span></label>
                            <input type="number" id="porcentajeRentabilidad_ser" name="porcentajeRentabilidad_ser"
                                   class="form-control" step="0.01" min="0" max="100" required
                                   placeholder="15.00" value="<?= old('porcentajeRentabilidad_ser') ?>"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                        </div>
                        <div class="col-md-4">
                            <label for="duracionServicio_ser" class="form-label">Duración (min) <span class="text-danger">*</span></label>
                            <input type="number" id="duracionServicio_ser" name="duracionServicio_ser" class="form-control"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   min="1" required placeholder="30" value="<?= old('duracionServicio_ser') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-info text-white"><i class="fas fa-save me-1"></i> Guardar Servicio</button>
                        <a href="<?= base_url('servicios') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo view('footer'); ?>
