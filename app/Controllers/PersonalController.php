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
        $data = [
            'idPersonal_per'       => $this->request->getPost('idPersonal_per'),
            'especialidadMedica_per'=> $this->request->getPost('especialidadMedica_per'),
            'horarioLaboral_per'   => $this->request->getPost('horarioLaboral_per'),
            'nivelDesempeno_per'   => $this->request->getPost('nivelDesempeno_per'),
            'tipoRol_per'          => $this->request->getPost('tipoRol_per'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('personal'))->with('success', 'Personal registrado.');
    }

    public function edit(int $id)
    {
        return view('personal/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'idPersonal_per'        => $this->request->getPost('idPersonal_per'),
            'especialidadMedica_per'=> $this->request->getPost('especialidadMedica_per'),
            'horarioLaboral_per'    => $this->request->getPost('horarioLaboral_per'),
            'nivelDesempeno_per'    => $this->request->getPost('nivelDesempeno_per'),
            'tipoRol_per'           => $this->request->getPost('tipoRol_per'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('personal'))->with('success', 'Personal actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('personal'))->with('success', 'Personal eliminado.');
    }
}
