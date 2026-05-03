<?php
namespace App\Models;
use CodeIgniter\Model;

class SistemaModel extends Model
{
    protected $table      = 'sistema';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nombreUsuario_sis', 'rolUsuario_sis', 'motorBaseDatos_sis',
        'nivelSeguridad_sis', 'tipoIntegracion_sis', 'estadoUsuario_sis',
    ];
}
