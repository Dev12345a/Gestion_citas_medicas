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
        $rules = [
            'nivelDemanda_ana'     => 'required',
            'fechaAnalisis_ana'    => 'required|valid_date',
            'nivelCompetencia_ana' => 'required',
            'tendenciaSalud_ana'   => 'required|max_length[100]',
            'normativaVigente_ana' => 'required|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nivelDemanda_ana'     => $this->request->getPost('nivelDemanda_ana'),
            'fechaAnalisis_ana'    => $this->request->getPost('fechaAnalisis_ana'),
            'nivelCompetencia_ana' => $this->request->getPost('nivelCompetencia_ana'),
            'tendenciaSalud_ana'   => $this->request->getPost('tendenciaSalud_ana'),
            'normativaVigente_ana' => $this->request->getPost('normativaVigente_ana'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis de mercado registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('analisis'))->with('error', 'Análisis no encontrado.');
        return view('analisis/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'nivelDemanda_ana'     => 'required',
            'fechaAnalisis_ana'    => 'required|valid_date',
            'nivelCompetencia_ana' => 'required',
            'tendenciaSalud_ana'   => 'required|max_length[100]',
            'normativaVigente_ana' => 'required|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nivelDemanda_ana'     => $this->request->getPost('nivelDemanda_ana'),
            'fechaAnalisis_ana'    => $this->request->getPost('fechaAnalisis_ana'),
            'nivelCompetencia_ana' => $this->request->getPost('nivelCompetencia_ana'),
            'tendenciaSalud_ana'   => $this->request->getPost('tendenciaSalud_ana'),
            'normativaVigente_ana' => $this->request->getPost('normativaVigente_ana'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('analisis'))->with('success', 'Análisis eliminado correctamente.');
    }
}
