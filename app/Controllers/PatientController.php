<?php

namespace App\Controllers;

use App\Models\PatientModel;

class PatientController extends BaseController
{
    protected PatientModel $patientModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();
    }

    // ── INDEX: Doctor ve SOLO sus pacientes (vía citas) ────────
    public function index()
    {
        // Mostrar todos los pacientes del sistema
        $patients = $this->patientModel->orderBy('nombreCompleto_pac', 'ASC')->findAll();

        return view('patients/index', ['patients' => $patients]);
    }

    public function create()
    {
        return view('patients/create');
    }

    public function store()
    {
        $rules = [
            'username_pac'          => 'required|min_length[4]|max_length[100]|is_unique[paciente.username_pac]',
            'password_pac'          => 'required|min_length[6]',
            'nombreCompleto_pac'    => 'required|min_length[3]|max_length[150]',
            'categoriaPaciente_pac' => 'required',
            'correoElectronico_pac' => 'permit_empty|valid_email|max_length[150]',
            'telefono_pac'          => 'permit_empty|max_length[20]',
            'direccion_pac'         => 'permit_empty|max_length[150]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->patientModel->insert([
            'username_pac'          => $this->request->getPost('username_pac'),
            'password_pac'          => $this->request->getPost('password_pac'),
            'nombreCompleto_pac'    => $this->request->getPost('nombreCompleto_pac'),
            'historialClinico_pac'  => $this->request->getPost('historialClinico_pac') ?? '',
            'categoriaPaciente_pac' => $this->request->getPost('categoriaPaciente_pac'),
            'correoElectronico_pac' => $this->request->getPost('correoElectronico_pac'),
            'telefono_pac'          => $this->request->getPost('telefono_pac'),
            'direccion_pac'         => $this->request->getPost('direccion_pac'),
        ]);

        return redirect()->to(base_url('patients'))->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(int $id)
    {
        $patient = $this->patientModel->find($id);
        if (!$patient) {
            return redirect()->to(base_url('patients'))->with('error', 'Paciente no encontrado.');
        }
        return view('patients/edit', ['patient' => $patient]);
    }

    public function update(int $id)
    {
        $patient = $this->patientModel->find($id);
        if (!$patient) {
            return redirect()->to(base_url('patients'))->with('error', 'Paciente no encontrado.');
        }

        $rules = [
            'username_pac'          => "required|min_length[4]|max_length[100]|is_unique[paciente.username_pac,idPaciente_pac,{$id}]",
            'password_pac'          => 'required|min_length[6]',
            'nombreCompleto_pac'    => 'required|min_length[3]|max_length[150]',
            'categoriaPaciente_pac' => 'required',
            'correoElectronico_pac' => 'permit_empty|valid_email|max_length[150]',
            'telefono_pac'          => 'permit_empty|max_length[20]',
            'direccion_pac'         => 'permit_empty|max_length[150]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->patientModel->update($id, [
            'username_pac'          => $this->request->getPost('username_pac'),
            'password_pac'          => $this->request->getPost('password_pac'),
            'nombreCompleto_pac'    => $this->request->getPost('nombreCompleto_pac'),
            'historialClinico_pac'  => $this->request->getPost('historialClinico_pac'),
            'categoriaPaciente_pac' => $this->request->getPost('categoriaPaciente_pac'),
            'correoElectronico_pac' => $this->request->getPost('correoElectronico_pac'),
            'telefono_pac'          => $this->request->getPost('telefono_pac'),
            'direccion_pac'         => $this->request->getPost('direccion_pac'),
        ]);

        return redirect()->to(base_url('patients'))->with('success', 'Paciente actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->patientModel->delete($id);
        return redirect()->to(base_url('patients'))->with('success', 'Paciente eliminado correctamente.');
    }

    // ── MI PERFIL: El propio paciente ve y edita su info ───────
    public function miPerfil()
    {
        $pacienteId = session()->get('user_id');
        $patient    = $this->patientModel->find($pacienteId);

        if (!$patient) {
            return redirect()->to(base_url('dashboard'))->with('error', 'Perfil no encontrado.');
        }

        return view('patients/mi_perfil', ['patient' => $patient]);
    }

    public function miPerfilUpdate()
    {
        $pacienteId = session()->get('user_id');
        $patient    = $this->patientModel->find($pacienteId);

        if (!$patient) {
            return redirect()->to(base_url('dashboard'))->with('error', 'Perfil no encontrado.');
        }

        $rules = [
            'correoElectronico_pac' => 'permit_empty|valid_email|max_length[150]',
            'telefono_pac'          => 'permit_empty|max_length[20]',
            'direccion_pac'         => 'permit_empty|max_length[150]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->patientModel->update($pacienteId, [
            'correoElectronico_pac' => $this->request->getPost('correoElectronico_pac'),
            'telefono_pac'          => $this->request->getPost('telefono_pac'),
            'direccion_pac'         => $this->request->getPost('direccion_pac'),
            'historialClinico_pac'  => $this->request->getPost('historialClinico_pac'),
        ]);

        return redirect()->to(base_url('mi-perfil'))->with('success', 'Tu perfil ha sido actualizado.');
    }

    // ── validateCode (stub conservado) ─────────────────────────
    public function validateCode(string $code)
    {
        return redirect()->to(base_url('patients'));
    }
}
