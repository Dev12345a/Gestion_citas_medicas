<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowUpModel extends Model
{
    protected $table      = 'follow_ups';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'appointment_id',
        'patient_id',
        'doctor_id',
        'follow_up_date',
        'diagnosis',
        'treatment',
        'prescription',
        'next_appointment_date',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    public function getByPatient(int $patientId): array
    {
        return $this->select('follow_ups.*,
            doctors.first_name  AS doctor_first_name,
            doctors.last_name   AS doctor_last_name,
            specialties.name    AS specialty_name,
            appointments.appointment_date,
            appointments.appointment_time')
            ->join('doctors',      'doctors.id      = follow_ups.doctor_id')
            ->join('appointments', 'appointments.id = follow_ups.appointment_id')
            ->join('specialties',  'specialties.id  = appointments.specialty_id')
            ->where('follow_ups.patient_id', $patientId)
            ->orderBy('follow_ups.follow_up_date', 'DESC')
            ->findAll();
    }

    public function getByAppointment(int $appointmentId): ?array
    {
        return $this->where('appointment_id', $appointmentId)->first();
    }
}
