<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table      = 'serviciosmedicos';
    protected $primaryKey = 'idServicio_ser';

    protected $allowedFields = [
        'nombreServicio_ser',
        'estadoServicio_ser',
        'precioConsulta_ser',
        'porcentajeRentabilidad_ser',
        'tipoPaquete_ser',
        'duracionServicio_ser',
    ];

    protected $useTimestamps = false;
}
