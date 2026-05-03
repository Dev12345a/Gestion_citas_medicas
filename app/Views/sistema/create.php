<?php echo view('header'); ?>
<div class="page-header"><h4 class="page-title">Nuevo Usuario del Sistema</h4></div>
<div class="col-md-6">
    <div class="card"><div class="card-body">
        <form method="POST" action="<?= base_url('sistema/store') ?>">
            <?= csrf_field() ?>
            <div class="mb-2"><label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombreUsuario_sis" class="form-control" value="<?= old('nombreUsuario_sis') ?>" required></div>
            <div class="mb-2"><label class="form-label">Rol</label>
                <select name="rolUsuario_sis" class="form-select">
                    <option>administrador</option><option>recepcionista</option><option>médico</option>
                </select></div>
            <div class="mb-2"><label class="form-label">Motor de Base de Datos</label>
                <input type="text" name="motorBaseDatos_sis" class="form-control" value="<?= old('motorBaseDatos_sis') ?>" placeholder="MySQL"></div>
            <div class="mb-2"><label class="form-label">Nivel de Seguridad</label>
                <select name="nivelSeguridad_sis" class="form-select">
                    <option>Alta</option><option>Media</option><option>Baja</option>
                </select></div>
            <div class="mb-2"><label class="form-label">Tipo de Integración</label>
                <input type="text" name="tipoIntegracion_sis" class="form-control" value="<?= old('tipoIntegracion_sis') ?>"></div>
            <div class="mb-2"><label class="form-label">Estado</label>
                <select name="estadoUsuario_sis" class="form-select">
                    <option>Activo</option><option>Inactivo</option>
                </select></div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('sistema') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
<?php echo view('footer'); ?>
