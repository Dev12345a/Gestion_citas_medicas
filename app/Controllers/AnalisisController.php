<?php
namespace App\Controllers;
use App\Models\AnalisisModel;

class AnalisisController extends BaseController
{
    protected AnalisisModel $model;

    public function __construct()
    {
        $this->model = new AnalisisModel();
    }

    public function index()
    {
        return view('analisis/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('analisis/create');
    }

    public function store()
    {
        $data = [
            'nivelDemanda_ana'     => $this->request->getPost('nivelDemanda_ana'),
            'fechaAnalisis_ana'    => $this->request->getPost('fechaAnalisis_ana'),
            'nivelCompetencia_ana' => $this->request->getPost('nivelCompetencia_ana'),
            'tendenciaSalud_ana'   => $this->request->getPost('tendenciaSalud_ana'),
            'normativaVigente_ana' => $this->request->getPost('normativaVigente_ana'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis registrado.');
    }

    public function edit(int $id)
    {
        return view('analisis/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'nivelDemanda_ana'     => $this->request->getPost('nivelDemanda_ana'),
            'fechaAnalisis_ana'    => $this->request->getPost('fechaAnalisis_ana'),
            'nivelCompetencia_ana' => $this->request->getPost('nivelCompetencia_ana'),
            'tendenciaSalud_ana'   => $this->request->getPost('tendenciaSalud_ana'),
            'normativaVigente_ana' => $this->request->getPost('normativaVigente_ana'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis eliminado.');
    }
}
