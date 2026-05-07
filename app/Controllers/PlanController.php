<?php
namespace App\Controllers;
use App\Models\PlanModel;

class PlanController extends BaseController
{
    protected PlanModel $model;

    public function __construct()
    {
        $this->model = new PlanModel();
    }

    public function index()
    {
        return view('plan/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('plan/create');
    }

    public function store()
    {
        $rules = [
            'ObjetivoGeneral_pla'     => 'required|min_length[5]|max_length[255]',
            'misionSistema_pla'       => 'required|min_length[5]|max_length[255]',
            'visionSistema_pla'       => 'required|min_length[5]|max_length[255]',
            'indicadorRendimiento_pla'=> 'required|decimal',
            'metaAnual_pla'           => 'required|integer|greater_than[0]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'ObjetivoGeneral_pla'      => $this->request->getPost('ObjetivoGeneral_pla'),
            'misionSistema_pla'        => $this->request->getPost('misionSistema_pla'),
            'visionSistema_pla'        => $this->request->getPost('visionSistema_pla'),
            'indicadorRendimiento_pla' => $this->request->getPost('indicadorRendimiento_pla'),
            'metaAnual_pla'            => $this->request->getPost('metaAnual_pla'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('plan'))->with('success', 'Plan estratégico registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('plan'))->with('error', 'Plan no encontrado.');
        return view('plan/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'ObjetivoGeneral_pla'     => 'required|min_length[5]|max_length[255]',
            'misionSistema_pla'       => 'required|min_length[5]|max_length[255]',
            'visionSistema_pla'       => 'required|min_length[5]|max_length[255]',
            'indicadorRendimiento_pla'=> 'required|decimal',
            'metaAnual_pla'           => 'required|integer|greater_than[0]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'ObjetivoGeneral_pla'      => $this->request->getPost('ObjetivoGeneral_pla'),
            'misionSistema_pla'        => $this->request->getPost('misionSistema_pla'),
            'visionSistema_pla'        => $this->request->getPost('visionSistema_pla'),
            'indicadorRendimiento_pla' => $this->request->getPost('indicadorRendimiento_pla'),
            'metaAnual_pla'            => $this->request->getPost('metaAnual_pla'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('plan'))->with('success', 'Plan estratégico actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('plan'))->with('success', 'Plan eliminado correctamente.');
    }
}
