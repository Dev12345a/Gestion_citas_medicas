<?php
namespace App\Models;
use CodeIgniter\Model;

class PersonalModel extends Model
{
    protected $table      = 'personal';
    protected $primaryKey = 'idMedico_per';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'idPersonal_per', 'especialidadMedica_per', 'horarioLaboral_per',
        'nivelDesempeno_per', 'tipoRol_per',
    ];
}
