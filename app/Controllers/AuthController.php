<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\PersonalModel;

class AuthController extends BaseController
{
    protected PatientModel  $patientModel;
    protected PersonalModel $personalModel;

    public function __construct()
    {
        $this->patientModel  = new PatientModel();
        $this->personalModel = new PersonalModel();
    }

    // ── LOGIN ──────────────────────────────────────────────────
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function attempt()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 1) Buscar como DOCTOR en personal
        $doctor = $this->personalModel->findByUsername($username);
        if ($doctor && $doctor['password_per'] === $password) {
            session()->set([
                'logged_in' => true,
                'user_name' => $doctor['especialidadMedica_per'] . ' — ' . ucfirst(str_replace('dr.', 'Dr. ', $username)),
                'user_role' => 'doctor',
                'user_id'   => $doctor['idMedico_per'],
            ]);
            return redirect()->to(base_url('dashboard'));
        }

        // 2) Buscar como PACIENTE
        $patient = $this->patientModel->findByUsername($username);
        if ($patient && $patient['password_pac'] === $password) {
            session()->set([
                'logged_in' => true,
                'user_name' => $patient['nombreCompleto_pac'],
                'user_role' => 'paciente',
                'user_id'   => $patient['idPaciente_pac'],
            ]);
            return redirect()->to(base_url('dashboard'));
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
    }

    // ── REGISTER (solo pacientes) ──────────────────────────────
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/register');
    }

    public function doRegister()
    {
        $rules = [
            'username_pac'          => 'required|min_length[4]|max_length[100]|is_unique[paciente.username_pac]',
            'nombreCompleto_pac'    => 'required|min_length[3]|max_length[150]',
            'correoElectronico_pac' => 'required|valid_email|max_length[150]',
            'telefono_pac'          => 'required|max_length[20]',
            'direccion_pac'         => 'required|max_length[150]',
            'password'              => 'required|min_length[6]',
            'password_confirm'      => 'required|matches[password]',
        ];

        $messages = [
            'username_pac'      => ['required' => 'El usuario es obligatorio.', 'is_unique'  => 'Ese nombre de usuario ya está en uso.'],
            'nombreCompleto_pac'=> ['required' => 'El nombre completo es obligatorio.'],
            'correoElectronico_pac' => ['required' => 'El correo es obligatorio.', 'valid_email' => 'Correo no válido.'],
            'telefono_pac'      => ['required' => 'El teléfono es obligatorio.'],
            'direccion_pac'     => ['required' => 'La dirección es obligatoria.'],
            'password'          => ['required' => 'La contraseña es obligatoria.', 'min_length' => 'Mínimo 6 caracteres.'],
            'password_confirm'  => ['required' => 'Confirme su contraseña.', 'matches'  => 'Las contraseñas no coinciden.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->patientModel->insert([
            'username_pac'          => $this->request->getPost('username_pac'),
            'password_pac'          => $this->request->getPost('password'), // texto plano
            'nombreCompleto_pac'    => $this->request->getPost('nombreCompleto_pac'),
            'historialClinico_pac'  => $this->request->getPost('historialClinico_pac') ?? '',
            'categoriaPaciente_pac' => 'Nuevo',
            'correoElectronico_pac' => $this->request->getPost('correoElectronico_pac'),
            'telefono_pac'          => $this->request->getPost('telefono_pac'),
            'direccion_pac'         => $this->request->getPost('direccion_pac'),
        ]);

        return redirect()->to(base_url('login'))->with('success', '¡Cuenta creada! Ya puedes iniciar sesión.');
    }

    // ── LOGOUT ─────────────────────────────────────────────────
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
