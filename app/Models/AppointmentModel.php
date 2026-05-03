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
    ];

    protected $useTimestamps = false;

    /**
     * Retorna citas con nombre del paciente y nombre del servicio (JOIN).
     */
    public function getWithRelations(): array
    {
        return $this->db->table('citas')
            ->select('citas.*, paciente.nombreCompleto_pac, serviciosmedicos.nombreServicio_ser')
            ->join('paciente',         'paciente.idPaciente_pac = citas.idPaciente_cit', 'left')
            ->join('serviciosmedicos', 'serviciosmedicos.idServicio_ser = citas.idServicio_cit', 'left')
            ->orderBy('citas.fechaCita_cit', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function countAll(): int
    {
        return $this->db->table('citas')->countAllResults();
    }
}
