<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión Médica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <h3 class="text-center mb-1">Sistema de Gestión Médica</h3>
            <p class="text-center text-muted mb-3"><small>Fase de Desarrollo - MVP v0.1</small></p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <strong>Iniciar Sesión</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('login') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control"
                                   placeholder="admin" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="****" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <small>Credenciales demo: <strong>admin</strong> / <strong>1234</strong></small>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
