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

    /**
     * Listado de pacientes.
     */
    public function index()
    {
        $data['patients'] = $this->patientModel->findAll();
        return view('patients/index', $data);
    }

    /**
     * Formulario para registrar nuevo paciente.
     */
    public function create()
    {
        return view('patients/create');
    }

    /**
     * Guardar nuevo paciente en la BD.
     */
    public function store()
    {
        $rules = [
            'nombreCompleto_pac'   => 'required|min_length[3]|max_length[150]',
            'categoriaPaciente_pac'=> 'required',
            'correoElectronico_pac'=> 'permit_empty|valid_email',
            'telefono_pac'         => 'permit_empty|max_length[20]',
        ];

        $messages = [
            'nombreCompleto_pac' => [
                'required'   => 'El nombre completo es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('error',
                implode('<br>', array_values($this->validator->getErrors()))
            );
        }

        $data = [
            'nombreCompleto_pac'    => $this->request->getPost('nombreCompleto_pac'),
            'historialClinico_pac'  => $this->request->getPost('historialClinico_pac'),
            'categoriaPaciente_pac' => $this->request->getPost('categoriaPaciente_pac'),
            'correoElectronico_pac' => $this->request->getPost('correoElectronico_pac'),
            'telefono_pac'          => $this->request->getPost('telefono_pac'),
            'direccion_pac'         => $this->request->getPost('direccion_pac'),
        ];

        if ($this->patientModel->insert($data)) {
            return redirect()->to(base_url('patients'))->with('success', 'Paciente registrado correctamente.');
        }

        return redirect()->back()->withInput()->with('error', 'Error al guardar. Intente nuevamente.');
    }

    // ── Stubs para no romper rutas existentes ────────────────

    public function show(int $id)
    {
        return redirect()->to(base_url('patients'));
    }

    public function edit(int $id)
    {
        return redirect()->to(base_url('patients'));
    }

    public function update(int $id)
    {
        return redirect()->to(base_url('patients'));
    }

    public function delete(int $id)
    {
        return redirect()->to(base_url('patients'));
    }

    public function validateCode(string $code)
    {
        return $this->response->setJSON(['data' => []]);
    }
}
