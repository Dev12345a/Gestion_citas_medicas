<?php
namespace App\Controllers;
use App\Models\PersonalModel;

class PersonalController extends BaseController
{
    protected PersonalModel $model;

    public function __construct()
    {
        $this->model = new PersonalModel();
    }

    public function index()
    {
        return view('personal/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('personal/create');
    }

    public function store()
    {
        $rules = [
            'idPersonal_per'        => 'required|integer',
            'especialidadMedica_per'=> 'required|max_length[100]',
            'horarioLaboral_per'    => 'required|max_length[50]',
            'nivelDesempeno_per'    => 'required|decimal',
            'tipoRol_per'           => 'required',
            'username_per'          => 'permit_empty|min_length[4]|is_unique[personal.username_per]',
            'password'              => 'permit_empty|min_length[6]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'idPersonal_per'        => $this->request->getPost('idPersonal_per'),
            'especialidadMedica_per'=> $this->request->getPost('especialidadMedica_per'),
            'horarioLaboral_per'    => $this->request->getPost('horarioLaboral_per'),
            'nivelDesempeno_per'    => $this->request->getPost('nivelDesempeno_per'),
            'tipoRol_per'           => $this->request->getPost('tipoRol_per'),
        ];
        $username = $this->request->getPost('username_per');
        $password = $this->request->getPost('password');
        if ($username) {
            $data['username_per'] = $username;
            $data['password_per'] = $password ?: 'password';
        }
        $this->model->insert($data);
        return redirect()->to(base_url('personal'))->with('success', 'Personal médico registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('personal'))->with('error', 'Registro no encontrado.');
        return view('personal/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'especialidadMedica_per'=> 'required|max_length[100]',
            'horarioLaboral_per'    => 'required|max_length[50]',
            'nivelDesempeno_per'    => 'required|decimal',
            'tipoRol_per'           => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'idPersonal_per'        => $this->request->getPost('idPersonal_per'),
            'especialidadMedica_per'=> $this->request->getPost('especialidadMedica_per'),
            'horarioLaboral_per'    => $this->request->getPost('horarioLaboral_per'),
            'nivelDesempeno_per'    => $this->request->getPost('nivelDesempeno_per'),
            'tipoRol_per'           => $this->request->getPost('tipoRol_per'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('personal'))->with('success', 'Personal médico actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('personal'))->with('success', 'Registro eliminado correctamente.');
    }
}
