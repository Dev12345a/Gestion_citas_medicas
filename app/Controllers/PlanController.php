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
        $data = [
            'ObjetivoGeneral_pla'       => $this->request->getPost('ObjetivoGeneral_pla'),
            'misionSistema_pla'         => $this->request->getPost('misionSistema_pla'),
            'visionSistema_pla'         => $this->request->getPost('visionSistema_pla'),
            'indicadorRendimiento_pla'  => $this->request->getPost('indicadorRendimiento_pla'),
            'metaAnual_pla'             => $this->request->getPost('metaAnual_pla'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('plan'))->with('success', 'Plan estratégico registrado.');
    }

    public function edit(int $id)
    {
        return view('plan/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'ObjetivoGeneral_pla'       => $this->request->getPost('ObjetivoGeneral_pla'),
            'misionSistema_pla'         => $this->request->getPost('misionSistema_pla'),
            'visionSistema_pla'         => $this->request->getPost('visionSistema_pla'),
            'indicadorRendimiento_pla'  => $this->request->getPost('indicadorRendimiento_pla'),
            'metaAnual_pla'             => $this->request->getPost('metaAnual_pla'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('plan'))->with('success', 'Plan estratégico actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('plan'))->with('success', 'Plan estratégico eliminado.');
    }
}
