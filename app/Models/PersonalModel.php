<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonalModel extends Model
{
    protected $table      = 'personal';
    protected $primaryKey = 'idMedico_per';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'username_per',
        'password_per',
        'idPersonal_per',
        'especialidadMedica_per',
        'horarioLaboral_per',
        'nivelDesempeno_per',
        'tipoRol_per',
    ];

    public function findByUsername(string $username): ?array
    {
        return $this->where('username_per', $username)->first();
    }
}
