<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\DoctorModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $patientModel     = new PatientModel();
        $appointmentModel = new AppointmentModel();
        $doctorModel      = new DoctorModel();

        $data = [
            'total_patients'     => $patientModel->countAll(),
            'total_appointments' => $appointmentModel->countAll(),
            'total_doctors'      => $doctorModel->countAll(),
        ];

        return view('dashboard', $data);
    }
}
