<?php echo view('header'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title mb-0"><i class="fas fa-edit me-2 text-warning"></i>Editar Servicio Médico</h4>
    <a href="<?= base_url('servicios') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-stethoscope me-2"></i>Servicio ID: <?= $item['idServicio_ser'] ?></h5></div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('servicios/update/'.$item['idServicio_ser']) ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nombreServicio_ser" class="form-label">Nombre del Servicio <span class="text-danger">*</span></label>
                            <input type="text" id="nombreServicio_ser" name="nombreServicio_ser" class="form-control" required
                                   value="<?= esc(old('nombreServicio_ser', $item['nombreServicio_ser'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="estadoServicio_ser" class="form-label">Estado</label>
                            <select id="estadoServicio_ser" name="estadoServicio_ser" class="form-select" required>
                                <option value="Disponible" <?= old('estadoServicio_ser', $item['estadoServicio_ser']) === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                                <option value="NoDisponible" <?= old('estadoServicio_ser', $item['estadoServicio_ser']) === 'NoDisponible' ? 'selected' : '' ?>>No Disponible</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoPaquete_ser" class="form-label">Tipo de Paquete</label>
                            <select id="tipoPaquete_ser" name="tipoPaquete_ser" class="form-select" required>
                                <?php foreach (['Básico','Premium','Virtual','Familiar','Ejecutivo'] as $t): ?>
                                    <option value="<?= $t ?>" <?= old('tipoPaquete_ser', $item['tipoPaquete_ser']) === $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="precioConsulta_ser" class="form-label">Precio ($)</label>
                            <input type="number" id="precioConsulta_ser" name="precioConsulta_ser" class="form-control"
                                   step="0.01" min="0" required value="<?= old('precioConsulta_ser', $item['precioConsulta_ser']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="porcentajeRentabilidad_ser" class="form-label">Rentabilidad (%)</label>
                            <input type="number" id="porcentajeRentabilidad_ser" name="porcentajeRentabilidad_ser"
                                   class="form-control" step="0.01" min="0" max="100" required
                                   value="<?= old('porcentajeRentabilidad_ser', $item['porcentajeRentabilidad_ser']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="duracionServicio_ser" class="form-label">Duración (min)</label>
                            <input type="number" id="duracionServicio_ser" name="duracionServicio_ser" class="form-control"
                                   min="1" required value="<?= old('duracionServicio_ser', $item['duracionServicio_ser']) ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-1"></i> Actualizar</button>
                        <a href="<?= base_url('servicios') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo view('footer'); ?>
