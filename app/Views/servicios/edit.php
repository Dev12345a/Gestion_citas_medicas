<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Editar Servicio Médico</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('servicios/update/'.$item['idServicio_ser']) ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Nombre del Servicio</label>
                <input type="text" name="nombreServicio_ser" class="form-control" value="<?= esc($item['nombreServicio_ser']) ?>" required></div>
            <div class="mb-2"><label class="form-label">Estado</label>
                <select name="estadoServicio_ser" class="form-select">
                    <option <?= $item['estadoServicio_ser']==='Disponible'?'selected':'' ?>>Disponible</option>
                    <option <?= $item['estadoServicio_ser']==='NoDisponible'?'selected':'' ?>>NoDisponible</option>
                </select></div>
            <div class="mb-2"><label class="form-label">Precio Consulta</label>
                <input type="number" step="0.01" name="precioConsulta_ser" class="form-control" value="<?= esc($item['precioConsulta_ser']) ?>"></div>
            <div class="mb-2"><label class="form-label">% Rentabilidad</label>
                <input type="number" step="0.01" name="porcentajeRentabilidad_ser" class="form-control" value="<?= esc($item['porcentajeRentabilidad_ser']) ?>"></div>
            <div class="mb-2"><label class="form-label">Tipo de Paquete</label>
                <input type="text" name="tipoPaquete_ser" class="form-control" value="<?= esc($item['tipoPaquete_ser']) ?>"></div>
            <div class="mb-2"><label class="form-label">Duración (minutos)</label>
                <input type="number" name="duracionServicio_ser" class="form-control" value="<?= esc($item['duracionServicio_ser']) ?>"></div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('servicios') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
