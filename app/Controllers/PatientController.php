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

    public function index()
    {
        $data['patients'] = $this->patientModel->findAll();
        return view('patients/index', $data);
    }

    public function create()
    {
        return view('patients/create');
    }

    public function store()
    {
        $rules = [
            'code'       => 'required|min_length[3]|max_length[50]',
            'first_name' => 'required|regex_match[/^[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+$/u]',
            'last_name'  => 'required|regex_match[/^[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+$/u]',
            'gender'     => 'required|in_list[M,F,O]',
        ];

        $messages = [
            'first_name' => [
                'regex_match' => 'El campo Nombre(s) solo debe contener letras y espacios (sin números).',
            ],
            'last_name' => [
                'regex_match' => 'El campo Apellidos solo debe contener letras y espacios (sin números).',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('error',
                implode('<br>', array_values($this->validator->getErrors()))
            );
        }

        $data = $this->request->getPost();
        $data['is_active'] = $this->request->getPost('is_active') ? 1 : 0;

        // Verificar código único
        if (!$this->patientModel->validateCode($data['code'])) {
            return redirect()->back()->withInput()->with('error', 'El código ya está registrado. Usa uno diferente.');
        }

        if ($this->patientModel->save($data)) {
            return redirect()->to(base_url('patients'))->with('success', 'Paciente registrado correctamente.');
        }

        return redirect()->back()->withInput()->with('error', 'Error al guardar el paciente. Intente nuevamente.');
    }

    // ── Métodos conservados para no romrar rutas existentes ──

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
        $isValid = $this->patientModel->validateCode($code);
        return $this->response->setJSON(['data' => $isValid ? [] : ['exists' => true]]);
    }
}
