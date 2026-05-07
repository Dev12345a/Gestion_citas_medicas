<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Sistema de Citas Médicas</title>
    <meta name="description" content="Accede al Sistema Digital de Gestión de Citas Médicas">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .login-wrapper {
            width: 100%; max-width: 440px; padding: 1rem;
        }
        .brand-icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #00d2ff, #3a7bd5);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 32px rgba(0,210,255,.35);
        }
        .card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 24px 64px rgba(0,0,0,.45);
        }
        h2 { color: #fff; font-weight: 700; font-size: 1.6rem; }
        p.subtitle { color: rgba(255,255,255,.55); font-size: .88rem; }
        label { color: rgba(255,255,255,.8); font-size: .85rem; font-weight: 500; margin-bottom: .3rem; display: block; }
        .form-control {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            color: #fff; border-radius: 10px; padding: .7rem 1rem;
            transition: all .25s;
        }
        .form-control:focus {
            background: rgba(255,255,255,.13);
            border-color: #00d2ff;
            box-shadow: 0 0 0 3px rgba(0,210,255,.18);
            color: #fff;
        }
        .form-control::placeholder { color: rgba(255,255,255,.3); }
        .input-group-text {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-right: none; color: rgba(255,255,255,.5);
        }
        .input-group .form-control { border-left: none; }
        .btn-login {
            background: linear-gradient(135deg, #00d2ff, #3a7bd5);
            border: none; color: #fff; font-weight: 600;
            padding: .75rem; border-radius: 10px; font-size: 1rem;
            transition: all .3s; letter-spacing: .5px;
        }
        .btn-login:hover { opacity: .88; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(0,210,255,.35); color:#fff; }
        .divider { border-color: rgba(255,255,255,.12); }
        .register-link { color: #00d2ff; text-decoration: none; font-weight: 600; }
        .register-link:hover { color: #7dd3fc; }
        .alert-danger { background: rgba(220,53,69,.2); border: 1px solid rgba(220,53,69,.4); color: #fca5a5; border-radius: 10px; }
        .alert-success { background: rgba(25,135,84,.2); border: 1px solid rgba(25,135,84,.4); color: #86efac; border-radius: 10px; }
        .demo-badge {
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 8px; padding: .5rem .8rem;
            font-size: .78rem; color: rgba(255,255,255,.5);
        }
        .demo-badge span { color: rgba(255,255,255,.8); font-weight: 600; }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="text-center mb-4">
        <div class="brand-icon"><i class="fas fa-hospital-alt"></i></div>
        <h2>Sistema de Citas Médicas</h2>
        <p class="subtitle mt-1">Gestión Digital de Salud — Acceso al Sistema</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mb-3">
            <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mb-3">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="<?= base_url('login') ?>" id="loginForm">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="username">Usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="username" name="username" class="form-control"
                           placeholder="Ingresa tu usuario" required autocomplete="username">
                </div>
            </div>

            <div class="mb-4">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required autocomplete="current-password">
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 mb-4">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </button>

            <hr class="divider my-3">

            <p class="text-center mb-0" style="color:rgba(255,255,255,.55); font-size:.88rem;">
                ¿Eres paciente nuevo?
                <a href="<?= base_url('register') ?>" class="register-link ms-1">Crear cuenta</a>
            </p>
        </form>

    </div>
</div>
</body>
</html>
