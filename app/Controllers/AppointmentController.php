<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\ServiciosModel;

class AppointmentController extends BaseController
{
    protected AppointmentModel $appointmentModel;
    protected PatientModel     $patientModel;
    protected ServiciosModel   $servicioModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->patientModel     = new PatientModel();
        $this->servicioModel    = new ServiciosModel();
    }

    // ── INDEX ────────────────────────────────────────────────────
    public function index()
    {
        $role     = session()->get('user_role');
        $userId   = session()->get('user_id');

        if ($role === 'doctor') {
            // Doctor: solo sus propias citas
            $appointments = $this->appointmentModel->getByDoctor($userId);
        } else {
            // Paciente: solo sus propias citas
            $appointments = $this->appointmentModel->getByPatient($userId);
        }

        return view('appointments/index', ['appointments' => $appointments]);
    }

    // ── CREATE / STORE (solo doctor) ─────────────────────────────
    public function create()
    {
        $doctorId = session()->get('user_id');
        // Mostrar todos los pacientes para poder asignar
        $patients = $this->patientModel->orderBy('nombreCompleto_pac', 'ASC')->findAll();

        return view('appointments/create', [
            'patients'  => $patients,
            'servicios' => $this->servicioModel->findAll(),
        ]);
    }

    public function store()
    {
        $rules = [
            'idCita_cit'            => 'required|max_length[50]|is_unique[citas.idCita_cit]',
            'fechaCita_cit'         => 'required|valid_date',
            'horaCita_cit'          => 'required',
            'estadoCita_cit'        => 'required',
            'tipoRecordatorio_cit'  => 'required',
            'nivelSatisfaccion_cit' => 'required|decimal',
            'idPaciente_cit'        => 'required|integer',
            'idServicio_cit'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->appointmentModel->insert([
            'idCita_cit'            => $this->request->getPost('idCita_cit'),
            'fechaCita_cit'         => $this->request->getPost('fechaCita_cit'),
            'horaCita_cit'          => $this->request->getPost('horaCita_cit'),
            'estadoCita_cit'        => $this->request->getPost('estadoCita_cit'),
            'tipoRecordatorio_cit'  => $this->request->getPost('tipoRecordatorio_cit'),
            'nivelSatisfaccion_cit' => $this->request->getPost('nivelSatisfaccion_cit'),
            'idPaciente_cit'        => $this->request->getPost('idPaciente_cit'),
            'idServicio_cit'        => $this->request->getPost('idServicio_cit'),
            'idMedico_cit'          => session()->get('user_id'), // asigna al doctor que crea
        ]);

        return redirect()->to(base_url('appointments'))->with('success', 'Cita registrada correctamente.');
    }

    // ── EDIT / UPDATE (solo doctor) ──────────────────────────────
    public function edit(string $id)
    {
        $appointment = $this->appointmentModel->find($id);
        if (!$appointment) {
            return redirect()->to(base_url('appointments'))->with('error', 'Cita no encontrada.');
        }

        // El doctor solo puede editar SUS citas
        if ($appointment['idMedico_cit'] != session()->get('user_id')) {
            return redirect()->to(base_url('appointments'))->with('error', 'No tienes permiso para editar esta cita.');
        }

        $doctorId = session()->get('user_id');
        // Mostrar todos los pacientes para poder asignar
        $patients = $this->patientModel->orderBy('nombreCompleto_pac', 'ASC')->findAll();

        return view('appointments/edit', [
            'appointment' => $appointment,
            'patients'    => $patients,
            'servicios'   => $this->servicioModel->findAll(),
        ]);
    }

    public function update(string $id)
    {
        $appointment = $this->appointmentModel->find($id);
        if (!$appointment) {
            return redirect()->to(base_url('appointments'))->with('error', 'Cita no encontrada.');
        }
        if ($appointment['idMedico_cit'] != session()->get('user_id')) {
            return redirect()->to(base_url('appointments'))->with('error', 'No tienes permiso.');
        }

        $rules = [
            'fechaCita_cit'         => 'required|valid_date',
            'horaCita_cit'          => 'required',
            'estadoCita_cit'        => 'required',
            'tipoRecordatorio_cit'  => 'required',
            'nivelSatisfaccion_cit' => 'required|decimal',
            'idPaciente_cit'        => 'required|integer',
            'idServicio_cit'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->appointmentModel->update($id, [
            'fechaCita_cit'         => $this->request->getPost('fechaCita_cit'),
            'horaCita_cit'          => $this->request->getPost('horaCita_cit'),
            'estadoCita_cit'        => $this->request->getPost('estadoCita_cit'),
            'tipoRecordatorio_cit'  => $this->request->getPost('tipoRecordatorio_cit'),
            'nivelSatisfaccion_cit' => $this->request->getPost('nivelSatisfaccion_cit'),
            'idPaciente_cit'        => $this->request->getPost('idPaciente_cit'),
            'idServicio_cit'        => $this->request->getPost('idServicio_cit'),
        ]);

        return redirect()->to(base_url('appointments'))->with('success', 'Cita actualizada correctamente.');
    }

    // ── CANCEL / DELETE (solo doctor) ────────────────────────────
    public function cancel(string $id)
    {
        $appointment = $this->appointmentModel->find($id);
        if (!$appointment || $appointment['idMedico_cit'] != session()->get('user_id')) {
            return redirect()->to(base_url('appointments'))->with('error', 'Acción no permitida.');
        }
        $this->appointmentModel->update($id, ['estadoCita_cit' => 'Cancelada']);
        return redirect()->to(base_url('appointments'))->with('success', 'Cita cancelada.');
    }

    public function delete(string $id)
    {
        $this->appointmentModel->delete($id);
        return redirect()->to(base_url('appointments'))->with('success', 'Cita eliminada.');
    }

    public function show(int $id)  { return redirect()->to(base_url('appointments')); }
    public function saveFollowUp(int $id) { return redirect()->to(base_url('appointments')); }
}
