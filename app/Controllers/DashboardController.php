<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\ServiciosModel;
use App\Models\PersonalModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data = [
            'total_patients'     => (new PatientModel())->countAllResults(),
            'total_appointments' => (new AppointmentModel())->countAll(),
            'total_servicios'    => $db->table('serviciosmedicos')->countAllResults(),
            'total_personal'     => $db->table('personal')->countAllResults(),
        ];

        return view('dashboard', $data);
    }
}
