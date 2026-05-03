<?php

namespace App\Controllers;

/**
 * DoctorController — MVP stub.
 * El módulo de médicos no está implementado en esta fase del proyecto.
 * Todas las rutas redirigen al Dashboard para evitar errores.
 */
class DoctorController extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('dashboard'))->with('error', 'El módulo de Médicos no está disponible en esta versión del MVP.');
    }

    public function create()
    {
        return redirect()->to(base_url('dashboard'));
    }

    public function store()
    {
        return redirect()->to(base_url('dashboard'));
    }

    public function edit(int $id)
    {
        return redirect()->to(base_url('dashboard'));
    }

    public function update(int $id)
    {
        return redirect()->to(base_url('dashboard'));
    }

    public function delete(int $id)
    {
        return redirect()->to(base_url('dashboard'));
    }

    public function bySpecialty(int $specialtyId)
    {
        return $this->response->setJSON([]);
    }
}
