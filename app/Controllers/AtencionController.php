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
        $rules = [
            'tipoPlanAtencion_ate'    => 'required|max_length[100]',
            'horarioDisponible_ate'   => 'required|max_length[50]',
            'promocionActiva_ate'     => 'required|max_length[100]',
            'nivelPersonalizacion_ate'=> 'required|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'tipoPlanAtencion_ate'    => $this->request->getPost('tipoPlanAtencion_ate'),
            'horarioDisponible_ate'   => $this->request->getPost('horarioDisponible_ate'),
            'promocionActiva_ate'     => $this->request->getPost('promocionActiva_ate'),
            'nivelPersonalizacion_ate'=> $this->request->getPost('nivelPersonalizacion_ate'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan de atención registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('atencion'))->with('error', 'Plan no encontrado.');
        return view('atencion/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'tipoPlanAtencion_ate'    => 'required|max_length[100]',
            'horarioDisponible_ate'   => 'required|max_length[50]',
            'promocionActiva_ate'     => 'required|max_length[100]',
            'nivelPersonalizacion_ate'=> 'required|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'tipoPlanAtencion_ate'    => $this->request->getPost('tipoPlanAtencion_ate'),
            'horarioDisponible_ate'   => $this->request->getPost('horarioDisponible_ate'),
            'promocionActiva_ate'     => $this->request->getPost('promocionActiva_ate'),
            'nivelPersonalizacion_ate'=> $this->request->getPost('nivelPersonalizacion_ate'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan de atención actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('atencion'))->with('success', 'Plan eliminado correctamente.');
    }
}
