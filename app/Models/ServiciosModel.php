<?php
namespace App\Models;
use CodeIgniter\Model;

class ServiciosModel extends Model
{
    protected $table      = 'serviciosmedicos';
    protected $primaryKey = 'idServicio_ser';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nombreServicio_ser', 'estadoServicio_ser', 'precioConsulta_ser',
        'porcentajeRentabilidad_ser', 'tipoPaquete_ser', 'duracionServicio_ser',
    ];
}
