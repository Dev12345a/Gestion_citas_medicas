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
        $data = [
            'nombreServicio_ser'        => $this->request->getPost('nombreServicio_ser'),
            'estadoServicio_ser'        => $this->request->getPost('estadoServicio_ser'),
            'precioConsulta_ser'        => $this->request->getPost('precioConsulta_ser'),
            'porcentajeRentabilidad_ser'=> $this->request->getPost('porcentajeRentabilidad_ser'),
            'tipoPaquete_ser'           => $this->request->getPost('tipoPaquete_ser'),
            'duracionServicio_ser'      => $this->request->getPost('duracionServicio_ser'),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio registrado.');
    }

    public function edit(int $id)
    {
        return view('servicios/edit', ['item' => $this->model->find($id)]);
    }

    public function update(int $id)
    {
        $data = [
            'nombreServicio_ser'        => $this->request->getPost('nombreServicio_ser'),
            'estadoServicio_ser'        => $this->request->getPost('estadoServicio_ser'),
            'precioConsulta_ser'        => $this->request->getPost('precioConsulta_ser'),
            'porcentajeRentabilidad_ser'=> $this->request->getPost('porcentajeRentabilidad_ser'),
            'tipoPaquete_ser'           => $this->request->getPost('tipoPaquete_ser'),
            'duracionServicio_ser'      => $this->request->getPost('duracionServicio_ser'),
        ];
        $this->model->update($id, $data);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio actualizado.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('servicios'))->with('success', 'Servicio eliminado.');
    }
}
