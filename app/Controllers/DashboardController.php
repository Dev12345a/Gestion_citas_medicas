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
        $role   = session()->get('user_role');
        $userId = session()->get('user_id');
        $db     = \Config\Database::connect();

        if ($role === 'doctor') {
            // Dashboard del doctor: sus estadísticas
            $data = [
                'role'              => 'doctor',
                'total_patients'    => $db->query("
                    SELECT COUNT(DISTINCT idPaciente_cit) as c FROM citas WHERE idMedico_cit = ?
                ", [$userId])->getRow()->c ?? 0,
                'total_appointments'=> (new AppointmentModel())->countByDoctor($userId),
                'total_servicios'   => $db->table('serviciosmedicos')->countAllResults(),
                'total_personal'    => $db->table('personal')->countAllResults(),
                'upcoming'          => $db->query("
                    SELECT c.*, p.nombreCompleto_pac, s.nombreServicio_ser
                    FROM citas c
                    LEFT JOIN paciente p ON p.idPaciente_pac = c.idPaciente_cit
                    LEFT JOIN serviciosmedicos s ON s.idServicio_ser = c.idServicio_cit
                    WHERE c.idMedico_cit = ? AND c.estadoCita_cit = 'Pendiente'
                    ORDER BY c.fechaCita_cit ASC LIMIT 5
                ", [$userId])->getResultArray(),
            ];
        } else {
            // Dashboard del paciente: solo sus datos
            $patient = (new PatientModel())->find($userId);
            $data = [
                'role'    => 'paciente',
                'patient' => $patient,
                'my_appointments' => (new AppointmentModel())->getByPatient($userId),
            ];
        }

        return view('dashboard', $data);
    }
}
