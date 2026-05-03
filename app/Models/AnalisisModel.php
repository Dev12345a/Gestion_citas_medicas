<?php
namespace App\Models;
use CodeIgniter\Model;

class AnalisisModel extends Model
{
    protected $table      = 'analisismercado';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nivelDemanda_ana', 'fechaAnalisis_ana', 'nivelCompetencia_ana',
        'tendenciaSalud_ana', 'normativaVigente_ana',
    ];
}
