<?php
namespace App\Controllers;
use App\Models\AtencionModel;

class AtencionController extends BaseController
{
    protected AtencionModel $model;

    public function __construct()
    {
        $this->model = new AtencionModel();
    }

    public function index()
    {
        return view('atencion/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('atencion/create');
    }

    public function store()
    {
        $data = [
            'tipoPlanAtencion_ate'    => $this->request->getPost('tipoPlanAtencion_ate'),
            'horarioDisponible_ate'   => $this->request->getPost('horarioDisponible_ate'),
            'promocionActiva_ate'     => $this->request->getPost('promocionActiva_ate'),
            'nivelPersonalizacion_ate'=> $this->request->getPost('nivelPersonalizacion_ate'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan de atención registrado.');
    }

    public function edit(int $id)
    {
        return view('atencion/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'tipoPlanAtencion_ate'    => $this->request->getPost('tipoPlanAtencion_ate'),
            'horarioDisponible_ate'   => $this->request->getPost('horarioDisponible_ate'),
            'promocionActiva_ate'     => $this->request->getPost('promocionActiva_ate'),
            'nivelPersonalizacion_ate'=> $this->request->getPost('nivelPersonalizacion_ate'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan de atención actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan de atención eliminado.');
    }
}
