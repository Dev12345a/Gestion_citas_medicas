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
        $rules = [
            'nombreUsuario_sis'  => 'required|min_length[3]|max_length[50]',
            'rolUsuario_sis'     => 'required',
            'motorBaseDatos_sis' => 'required',
            'nivelSeguridad_sis' => 'required',
            'tipoIntegracion_sis'=> 'required',
            'estadoUsuario_sis'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nombreUsuario_sis'  => $this->request->getPost('nombreUsuario_sis'),
            'rolUsuario_sis'     => $this->request->getPost('rolUsuario_sis'),
            'motorBaseDatos_sis' => $this->request->getPost('motorBaseDatos_sis'),
            'nivelSeguridad_sis' => $this->request->getPost('nivelSeguridad_sis'),
            'tipoIntegracion_sis'=> $this->request->getPost('tipoIntegracion_sis'),
            'estadoUsuario_sis'  => $this->request->getPost('estadoUsuario_sis'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario del sistema registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('sistema'))->with('error', 'Usuario no encontrado.');
        return view('sistema/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'nombreUsuario_sis'  => 'required|min_length[3]|max_length[50]',
            'rolUsuario_sis'     => 'required',
            'motorBaseDatos_sis' => 'required',
            'nivelSeguridad_sis' => 'required',
            'tipoIntegracion_sis'=> 'required',
            'estadoUsuario_sis'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nombreUsuario_sis'  => $this->request->getPost('nombreUsuario_sis'),
            'rolUsuario_sis'     => $this->request->getPost('rolUsuario_sis'),
            'motorBaseDatos_sis' => $this->request->getPost('motorBaseDatos_sis'),
            'nivelSeguridad_sis' => $this->request->getPost('nivelSeguridad_sis'),
            'tipoIntegracion_sis'=> $this->request->getPost('tipoIntegracion_sis'),
            'estadoUsuario_sis'  => $this->request->getPost('estadoUsuario_sis'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('sistema'))->with('success', 'Usuario eliminado correctamente.');
    }
}
