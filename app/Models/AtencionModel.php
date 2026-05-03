<?php
namespace App\Models;
use CodeIgniter\Model;

class AtencionModel extends Model
{
    protected $table      = 'atencion';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'tipoPlanAtencion_ate', 'horarioDisponible_ate',
        'promocionActiva_ate', 'nivelPersonalizacion_ate',
    ];
}
