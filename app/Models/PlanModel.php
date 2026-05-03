<?php
namespace App\Models;
use CodeIgniter\Model;

class PlanModel extends Model
{
    protected $table      = 'planestrategico';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'ObjetivoGeneral_pla', 'misionSistema_pla', 'visionSistema_pla',
        'indicadorRendimiento_pla', 'metaAnual_pla',
    ];
}
