<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * DoctorFilter — bloquea el acceso a rutas de solo doctor.
 * Si el usuario logueado es 'paciente', redirige al dashboard con error.
 */
class DoctorFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Primero asegurarse de que esté logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Verificar que sea doctor
        if (session()->get('user_role') !== 'doctor') {
            return redirect()->to(base_url('dashboard'))
                ->with('error', 'Acceso restringido. Esta sección es solo para doctores.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nada
    }
}
