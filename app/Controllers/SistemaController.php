<?php
namespace App\Controllers;
use App\Models\SistemaModel;

class SistemaController extends BaseController
{
    protected SistemaModel $model;

    public function __construct()
    {
        $this->model = new SistemaModel();
    }

    public function index()
    {
        return view('sistema/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('sistema/create');
    }

    public function store()
    {
        $data = [
            'nombreUsuario_sis'  => $this->request->getPost('nombreUsuario_sis'),
            'rolUsuario_sis'     => $this->request->getPost('rolUsuario_sis'),
            'motorBaseDatos_sis' => $this->request->getPost('motorBaseDatos_sis'),
            'nivelSeguridad_sis' => $this->request->getPost('nivelSeguridad_sis'),
            'tipoIntegracion_sis'=> $this->request->getPost('tipoIntegracion_sis'),
            'estadoUsuario_sis'  => $this->request->getPost('estadoUsuario_sis'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario del sistema registrado.');
    }

    public function edit(int $id)
    {
        return view('sistema/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'nombreUsuario_sis'  => $this->request->getPost('nombreUsuario_sis'),
            'rolUsuario_sis'     => $this->request->getPost('rolUsuario_sis'),
            'motorBaseDatos_sis' => $this->request->getPost('motorBaseDatos_sis'),
            'nivelSeguridad_sis' => $this->request->getPost('nivelSeguridad_sis'),
            'tipoIntegracion_sis'=> $this->request->getPost('tipoIntegracion_sis'),
            'estadoUsuario_sis'  => $this->request->getPost('estadoUsuario_sis'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario eliminado.');
    }
}
