<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Usuario quemado en el controlador (sin BD) — MVP académico
        if ($username === 'admin' && $password === '123') {
            session()->set([
                'logged_in' => true,
                'user_name' => 'Administrador',
            ]);
            return redirect()->to(base_url('dashboard'));
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
