<?php

namespace App\Controllers;

/**
 * StatisticsController — MVP stub.
 * Módulo de estadísticas no implementado en esta fase.
 */
class StatisticsController extends BaseController
{
    public function statistics()
    {
        return redirect()->to(base_url('dashboard'))->with('error', 'El módulo de Estadísticas no está disponible en esta versión del MVP.');
    }
}