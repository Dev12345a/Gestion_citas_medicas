<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table      = 'citas';
    protected $primaryKey = 'idCita_cit';

    protected $allowedFields = [
        'idCita_cit',
        'fechaCita_cit',
        'estadoCita_cit',
        'tipoRecordatorio_cit',
        'nivelSatisfaccion_cit',
        'idPaciente_cit',
        'idServicio_cit',
        'idMedico_cit',
    ];

    protected $useTimestamps = false;

    /** Base join con paciente, servicio y médico */
    private function baseQuery()
    {
        return $this->db->table('citas')
            ->select('citas.*, paciente.nombreCompleto_pac, serviciosmedicos.nombreServicio_ser, personal.username_per AS medico_username')
            ->join('paciente',         'paciente.idPaciente_pac = citas.idPaciente_cit',         'left')
            ->join('serviciosmedicos', 'serviciosmedicos.idServicio_ser = citas.idServicio_cit', 'left')
            ->join('personal',         'personal.idMedico_per = citas.idMedico_cit',            'left');
    }

    /** Citas filtradas por doctor */
    public function getByDoctor(int $doctorId): array
    {
        return $this->baseQuery()
            ->where('citas.idMedico_cit', $doctorId)
            ->orderBy('citas.fechaCita_cit', 'DESC')
            ->get()->getResultArray();
    }

    /** Citas filtradas por paciente */
    public function getByPatient(int $patientId): array
    {
        return $this->baseQuery()
            ->where('citas.idPaciente_cit', $patientId)
            ->orderBy('citas.fechaCita_cit', 'DESC')
            ->get()->getResultArray();
    }

    /** Todas (para compatibilidad) */
    public function getWithRelations(): array
    {
        return $this->baseQuery()
            ->orderBy('citas.fechaCita_cit', 'DESC')
            ->get()->getResultArray();
    }

    public function countAll(): int
    {
        return $this->db->table('citas')->countAllResults();
    }

    public function countByDoctor(int $doctorId): int
    {
        return $this->db->table('citas')->where('idMedico_cit', $doctorId)->countAllResults();
    }
}
