<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\SpecialtyModel;

class StatisticsController extends BaseController
{
    public function statistics()
    {
        $appointmentModel = new AppointmentModel();
        $patientModel     = new PatientModel();
        $doctorModel      = new DoctorModel();
        $specialtyModel   = new SpecialtyModel();

        $db = \Config\Database::connect();

        // Totales generales
        $byStatus = $appointmentModel->countByStatus();

        // Citas por especialidad
        $bySpecialty = $db->query("
            SELECT s.name AS specialty_name, COUNT(a.id) AS total
            FROM appointments a
            JOIN specialties s ON s.id = a.specialty_id
            GROUP BY s.id, s.name
            ORDER BY total DESC
        ")->getResultArray();

        // Top 5 doctores con más citas
        $topDoctors = $db->query("
            SELECT CONCAT(d.first_name, ' ', d.last_name) AS doctor_name,
                   s.name AS specialty_name,
                   COUNT(a.id) AS total
            FROM appointments a
            JOIN doctors d ON d.id = a.doctor_id
            JOIN specialties s ON s.id = d.specialty_id
            GROUP BY d.id
            ORDER BY total DESC
            LIMIT 5
        ")->getResultArray();

        // Citas por mes (últimos 6 meses)
        $byMonth = $db->query("
            SELECT DATE_FORMAT(appointment_date, '%Y-%m') AS month,
                   COUNT(*) AS total
            FROM appointments
            WHERE appointment_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month ASC
        ")->getResultArray();

        // Totales de pacientes
        $allPatients    = $patientModel->findAll();
        $totalPatients  = count($allPatients);
        $activePatients = count(array_filter($allPatients, fn($p) => $p['is_active']));

        $data = [
            'totalAppointments'    => array_sum($byStatus),
            'todayAppointments'    => $appointmentModel->countToday(),
            'weekAppointments'     => $appointmentModel->countThisWeek(),
            'byStatus'             => $byStatus,
            'bySpecialty'          => $bySpecialty,
            'topDoctors'           => $topDoctors,
            'byMonth'              => $byMonth,
            'totalPatients'        => $totalPatients,
            'activePatients'       => $activePatients,
            'totalDoctors'         => count($doctorModel->findAll()),
        ];

        return view('statistics/index', $data);
    }
}