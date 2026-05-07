<?php
namespace App\Controllers;
use App\Models\ServiciosModel;

class ServiciosController extends BaseController
{
    protected ServiciosModel $model;

    public function __construct()
    {
        $this->model = new ServiciosModel();
    }

    public function index()
    {
        return view('servicios/index', ['items' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('servicios/create');
    }

    public function store()
    {
        $rules = [
            'nombreServicio_ser'         => 'required|min_length[3]|max_length[100]',
            'estadoServicio_ser'         => 'required',
            'precioConsulta_ser'         => 'required|decimal',
            'porcentajeRentabilidad_ser' => 'required|decimal',
            'tipoPaquete_ser'            => 'required',
            'duracionServicio_ser'       => 'required|integer|greater_than[0]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nombreServicio_ser'         => $this->request->getPost('nombreServicio_ser'),
            'estadoServicio_ser'         => $this->request->getPost('estadoServicio_ser'),
            'precioConsulta_ser'         => $this->request->getPost('precioConsulta_ser'),
            'porcentajeRentabilidad_ser' => $this->request->getPost('porcentajeRentabilidad_ser'),
            'tipoPaquete_ser'            => $this->request->getPost('tipoPaquete_ser'),
            'duracionServicio_ser'       => $this->request->getPost('duracionServicio_ser'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio médico registrado correctamente.');
    }

    public function edit(int $id)
    {
        $item = $this->model->find($id);
        if (!$item) return redirect()->to(base_url('servicios'))->with('error', 'Servicio no encontrado.');
        return view('servicios/edit', ['item' => $item]);
    }

    public function update(int $id)
    {
        $rules = [
            'nombreServicio_ser'         => 'required|min_length[3]|max_length[100]',
            'estadoServicio_ser'         => 'required',
            'precioConsulta_ser'         => 'required|decimal',
            'porcentajeRentabilidad_ser' => 'required|decimal',
            'tipoPaquete_ser'            => 'required',
            'duracionServicio_ser'       => 'required|integer|greater_than[0]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nombreServicio_ser'         => $this->request->getPost('nombreServicio_ser'),
            'estadoServicio_ser'         => $this->request->getPost('estadoServicio_ser'),
            'precioConsulta_ser'         => $this->request->getPost('precioConsulta_ser'),
            'porcentajeRentabilidad_ser' => $this->request->getPost('porcentajeRentabilidad_ser'),
            'tipoPaquete_ser'            => $this->request->getPost('tipoPaquete_ser'),
            'duracionServicio_ser'       => $this->request->getPost('duracionServicio_ser'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio eliminado correctamente.');
    }
}
