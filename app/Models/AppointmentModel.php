<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table      = 'appointments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'patient_id',
        'doctor_id',
        'specialty_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'status',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Retorna citas con datos de paciente, doctor y especialidad.
     */
    public function getWithRelations(array $filters = []): array
    {
        $this->select('appointments.*,
            patients.first_name  AS patient_first_name,
            patients.last_name   AS patient_last_name,
            patients.code        AS patient_code,
            doctors.first_name   AS doctor_first_name,
            doctors.last_name    AS doctor_last_name,
            doctors.code         AS doctor_code,
            specialties.name     AS specialty_name')
            ->join('patients',    'patients.id    = appointments.patient_id')
            ->join('doctors',     'doctors.id     = appointments.doctor_id')
            ->join('specialties', 'specialties.id = appointments.specialty_id');

        if (!empty($filters['status'])) {
            $this->where('appointments.status', $filters['status']);
        }
        if (!empty($filters['doctor_id'])) {
            $this->where('appointments.doctor_id', $filters['doctor_id']);
        }
        if (!empty($filters['patient_id'])) {
            $this->where('appointments.patient_id', $filters['patient_id']);
        }
        if (!empty($filters['date'])) {
            $this->where('appointments.appointment_date', $filters['date']);
        }

        return $this->orderBy('appointments.appointment_date', 'DESC')
            ->orderBy('appointments.appointment_time', 'ASC')
            ->findAll();
    }

    /**
     * Una sola cita con sus relaciones.
     */
    public function getOneWithRelations(int $id): ?array
    {
        return $this->select('appointments.*,
            patients.first_name  AS patient_first_name,
            patients.last_name   AS patient_last_name,
            patients.code        AS patient_code,
            patients.phone       AS patient_phone,
            patients.email       AS patient_email,
            doctors.first_name   AS doctor_first_name,
            doctors.last_name    AS doctor_last_name,
            doctors.code         AS doctor_code,
            specialties.name     AS specialty_name')
            ->join('patients',    'patients.id    = appointments.patient_id')
            ->join('doctors',     'doctors.id     = appointments.doctor_id')
            ->join('specialties', 'specialties.id = appointments.specialty_id')
            ->where('appointments.id', $id)
            ->first();
    }

    public function countByStatus(): array
    {
        $rows = $this->select('status, COUNT(*) as total')
            ->groupBy('status')
            ->findAll();

        $result = ['scheduled' => 0, 'confirmed' => 0, 'completed' => 0, 'cancelled' => 0, 'no_show' => 0];
        foreach ($rows as $row) {
            $result[$row['status']] = (int) $row['total'];
        }
        return $result;
    }

    public function countToday(): int
    {
        return $this->where('appointment_date', date('Y-m-d'))->countAllResults();
    }

    public function countThisWeek(): int
    {
        $start = date('Y-m-d', strtotime('monday this week'));
        $end   = date('Y-m-d', strtotime('sunday this week'));
        return $this->where('appointment_date >=', $start)->where('appointment_date <=', $end)->countAllResults();
    }
}
