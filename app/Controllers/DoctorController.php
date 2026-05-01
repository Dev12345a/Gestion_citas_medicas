<?php

namespace App\Controllers;

use App\Models\DoctorModel;

class DoctorController extends BaseController
{
    protected DoctorModel $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    /**
     * Lista todos los doctores con JOIN de especialidad.
     */
    public function index()
    {
        $data['doctors'] = $this->doctorModel->getWithSpecialty();
        return view('doctors/index', $data);
    }

    // ── Stubs para no romper rutas existentes ──

    public function create()
    {
        return redirect()->to(base_url('doctors'));
    }

    public function store()
    {
        return redirect()->to(base_url('doctors'));
    }

    public function edit(int $id)
    {
        return redirect()->to(base_url('doctors'));
    }

    public function update(int $id)
    {
        return redirect()->to(base_url('doctors'));
    }

    public function delete(int $id)
    {
        return redirect()->to(base_url('doctors'));
    }

    public function bySpecialty(int $specialtyId)
    {
        $doctors = $this->doctorModel->getBySpecialty($specialtyId);
        return $this->response->setJSON($doctors);
    }
}
