<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table      = 'paciente';
    protected $primaryKey = 'idPaciente_pac';

    protected $allowedFields = [
        'nombreCompleto_pac',
        'historialClinico_pac',
        'categoriaPaciente_pac',
        'correoElectronico_pac',
        'telefono_pac',
        'direccion_pac',
    ];

    protected $useTimestamps = false;
}