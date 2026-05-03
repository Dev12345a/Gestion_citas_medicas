<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Editar Usuario del Sistema</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('sistema/update/'.$item['id']) ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombreUsuario_sis" class="form-control" value="<?= esc($item['nombreUsuario_sis']) ?>"></div>
            <div class="mb-2"><label class="form-label">Rol</label>
                <select name="rolUsuario_sis" class="form-select">
                    <?php foreach(['administrador','recepcionista','médico'] as $opt): ?>
                    <option <?= $item['rolUsuario_sis']===$opt?'selected':'' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-2"><label class="form-label">Motor de Base de Datos</label>
                <input type="text" name="motorBaseDatos_sis" class="form-control" value="<?= esc($item['motorBaseDatos_sis']) ?>"></div>
            <div class="mb-2"><label class="form-label">Nivel de Seguridad</label>
                <select name="nivelSeguridad_sis" class="form-select">
                    <?php foreach(['Alta','Media','Baja'] as $opt): ?>
                    <option <?= $item['nivelSeguridad_sis']===$opt?'selected':'' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-2"><label class="form-label">Tipo de Integración</label>
                <input type="text" name="tipoIntegracion_sis" class="form-control" value="<?= esc($item['tipoIntegracion_sis']) ?>"></div>
            <div class="mb-2"><label class="form-label">Estado</label>
                <select name="estadoUsuario_sis" class="form-select">
                    <?php foreach(['Activo','Inactivo'] as $opt): ?>
                    <option <?= $item['estadoUsuario_sis']===$opt?'selected':'' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select></div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('sistema') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
