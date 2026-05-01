<?php

namespace App\Controllers;

use App\Models\AppointmentModel;

class AppointmentController extends BaseController
{
    protected AppointmentModel $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    /**
     * Lista todas las citas con JOIN de paciente y doctor.
     */
    public function index()
    {
        $data['appointments'] = $this->appointmentModel->getWithRelations();
        return view('appointments/index', $data);
    }

    // ── Stubs para no romper rutas existentes ──

    public function create()
    {
        return redirect()->to(base_url('appointments'))->with('error', 'Agendar cita aún está en construcción.');
    }

    public function store()
    {
        return redirect()->to(base_url('appointments'));
    }

    public function show(int $id)
    {
        return redirect()->to(base_url('appointments'));
    }

    public function edit(int $id)
    {
        return redirect()->to(base_url('appointments'));
    }

    public function update(int $id)
    {
        return redirect()->to(base_url('appointments'));
    }

    public function cancel(int $id)
    {
        return redirect()->to(base_url('appointments'));
    }

    public function saveFollowUp(int $id)
    {
        return redirect()->to(base_url('appointments'));
    }
}
