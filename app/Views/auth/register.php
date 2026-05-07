<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Paciente — Sistema de Citas Médicas</title>
    <meta name="description" content="Crea tu cuenta de paciente en el Sistema de Citas Médicas">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            padding: 2rem 0;
        }
        .register-wrapper { width: 100%; max-width: 560px; padding: 1rem; }
        .brand-icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #00d2ff, #3a7bd5);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 32px rgba(0,210,255,.35);
        }
        h2 { color: #fff; font-weight: 700; font-size: 1.6rem; }
        p.subtitle { color: rgba(255,255,255,.55); font-size: .88rem; }
        .card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 24px 64px rgba(0,0,0,.45);
        }
        label { color: rgba(255,255,255,.8); font-size: .85rem; font-weight: 500; margin-bottom: .3rem; display: block; }
        .form-control, .form-select {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            color: #fff; border-radius: 10px; padding: .65rem 1rem;
            transition: all .25s;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,.13);
            border-color: #00d2ff;
            box-shadow: 0 0 0 3px rgba(0,210,255,.18);
            color: #fff;
        }
        .form-select option { background: #203a43; color: #fff; }
        .form-control::placeholder { color: rgba(255,255,255,.3); }
        .input-group-text {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-right: none; color: rgba(255,255,255,.5);
        }
        .input-group .form-control { border-left: none; }
        .invalid-feedback { color: #fca5a5; font-size: .78rem; }
        .btn-register {
            background: linear-gradient(135deg, #00d2ff, #3a7bd5);
            border: none; color: #fff; font-weight: 600;
            padding: .75rem; border-radius: 10px; font-size: 1rem;
            transition: all .3s;
        }
        .btn-register:hover { opacity:.88; transform:translateY(-1px); box-shadow:0 8px 24px rgba(0,210,255,.35); color:#fff; }
        .section-title { color: rgba(255,255,255,.45); font-size: .78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: .75rem; }
        .divider { border-color: rgba(255,255,255,.12); }
        .login-link { color: #00d2ff; text-decoration: none; font-weight: 600; }
        .login-link:hover { color: #7dd3fc; }
        .alert-danger { background: rgba(220,53,69,.2); border: 1px solid rgba(220,53,69,.4); color: #fca5a5; border-radius: 10px; font-size: .85rem; }
        .is-invalid { border-color: rgba(220,53,69,.7) !important; }
    </style>
</head>
<body>
<div class="register-wrapper">
    <div class="text-center mb-4">
        <div class="brand-icon"><i class="fas fa-user-plus"></i></div>
        <h2>Crear Cuenta de Paciente</h2>
        <p class="subtitle mt-1">Solo los pacientes pueden registrarse en el sistema</p>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger mb-3">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul class="mb-0 mt-1 ps-3">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="<?= base_url('register') ?>" id="registerForm" novalidate>
            <?= csrf_field() ?>

            <!-- Datos de acceso -->
            <p class="section-title"><i class="fas fa-key me-1"></i> Datos de Acceso</p>
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label for="username_pac">Nombre de Usuario <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="text" id="username_pac" name="username_pac" class="form-control"
                               placeholder="ej: juan.perez" value="<?= old('username_pac') ?>" required minlength="4">
                        <div class="invalid-feedback">Mínimo 4 caracteres, sin espacios.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password">Contraseña <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Mínimo 6 caracteres" required minlength="6">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password_confirm">Confirmar Contraseña <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control"
                               placeholder="Repite la contraseña" required>
                        <div class="invalid-feedback">Las contraseñas no coinciden.</div>
                    </div>
                </div>
            </div>

            <hr class="divider mb-4">

            <!-- Datos personales -->
            <p class="section-title"><i class="fas fa-id-card me-1"></i> Datos Personales</p>
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label for="nombreCompleto_pac">Nombre Completo <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="nombreCompleto_pac" name="nombreCompleto_pac" class="form-control"
                               placeholder="Ej: Juan Carlos Pérez" value="<?= old('nombreCompleto_pac') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="correoElectronico_pac">Correo Electrónico <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="correoElectronico_pac" name="correoElectronico_pac" class="form-control"
                               placeholder="correo@ejemplo.com" value="<?= old('correoElectronico_pac') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="telefono_pac">Teléfono <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" id="telefono_pac" name="telefono_pac" class="form-control"
                               placeholder="Ej: 0991234567" value="<?= old('telefono_pac') ?>" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="direccion_pac">Dirección <span style="color:#f87171">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" id="direccion_pac" name="direccion_pac" class="form-control"
                               placeholder="Ej: Av. Principal 123, Quito" value="<?= old('direccion_pac') ?>" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="historialClinico_pac">Historial Clínico (opcional)</label>
                    <textarea id="historialClinico_pac" name="historialClinico_pac" class="form-control"
                              rows="2" placeholder="Ej: Diabetes, Hipertensión..."><?= old('historialClinico_pac') ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-register w-100 mb-3" id="btnRegister">
                <i class="fas fa-user-plus me-2"></i>Crear mi Cuenta
            </button>

            <p class="text-center mb-0" style="color:rgba(255,255,255,.55); font-size:.88rem;">
                ¿Ya tienes cuenta?
                <a href="<?= base_url('login') ?>" class="login-link ms-1">Iniciar Sesión</a>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validación client-side
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const pass = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirm');
        if (pass !== confirm.value) {
            e.preventDefault();
            confirm.classList.add('is-invalid');
            confirm.nextElementSibling.style.display = 'block';
        }
    });

    document.getElementById('password_confirm').addEventListener('input', function() {
        const pass = document.getElementById('password').value;
        if (this.value === pass) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
</script>
</body>
</html>
