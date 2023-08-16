<?php

namespace App\Controllers;

use App\Models\CentroTechModel;
use App\Models\DispositivoModel;

class CentroTech extends BaseController
{
    public function index()
    {
        try {
            $model = model(CentroTechModel::class);
            $centrosTech = $model->findAll();
    
            return view('centrostech/index', [
                'centrosTech' => $centrosTech,
                'modulo' => 'administracion',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function detalles($id)
    {
        try {

            $model = model(CentroTechModel::class);
            $dispositivoModel = model(DispositivoModel::class);

            $centroTech = $model->find($id);
            $id = $centroTech['id'];

            $dispositivos = $dispositivoModel->where('centro_tech_id', $id)->findAll();
    
            return view('centrostech/detalles', [
                'centroTech' => $centroTech,
                'dispositivos' => $dispositivos,
                'modulo' => 'administracion',
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function agregar() {

        if ($this->request->getMethod() == 'post') {

            $model = model(CentroTechModel::class);

            $validacion = [
                'nombre' => 'required',
            ];

            $mensajesValidacion = [
                'nombre' => ['required' => 'Nombre es requerido',],
            ];

            if (!$this->validate($validacion, $mensajesValidacion)) {
                return view('centrostech/agregar', [
                    'modulo' => 'administracion',
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $nombre = $this->request->getPost('nombre');
            $descripcion = $this->request->getPost('descripcion');
            $activo = true;

            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'activo' => $activo,
            ];

            if ($model->insert($data)) {
                return redirect()->to('/centros-tech/agregar')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Centro tech agregado satisfactoriamente',
                    ]);
            }

            return view('centrostech/agregar', [
                    'errors' => $model->errors(),
                ]);
        }

        return view('centrostech/agregar', [
            'modulo' => 'administracion',
        ]);
    }

    public function editar($id) {

        $model = model(CentroTechModel::class);

        if ($this->request->getMethod() == 'post') {

            $validacion = [
                'nombre' => 'required',
            ];

            $mensajesValidacion = [
                'nombre' => ['required' => 'Nombre es requerido',],
            ];

            if (!$this->validate($validacion, $mensajesValidacion)) {
                $centroTech = $model->find($id);
                return view('centrostech/editar', [
                    'modulo' => 'administracion',
                    'centroTech' => $centroTech,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $id = $this->request->getPost('id');
            $nombre = $this->request->getPost('nombre');
            $descripcion = $this->request->getPost('descripcion');
            $activo = $this->request->getPost('activo');

            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'activo' => $activo,
            ];

            if ($model->update($id, $data)) {
                return redirect()->to('/centros-tech')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Centro tech editado satisfactoriamente',
                    ]);
            }

            return view('centrostech/editar', [
                    'errors' => $model->errors(),
                ]);
        }

        $centroTech = $model->find($id);

        return view('centrostech/editar', [
            'centroTech' => $centroTech,
            'modulo' => 'administracion',
        ]);
    }

    public function eliminar($id) {

        $model = model(CentroTechModel::class);

        if ($model->delete($id)) {
            return redirect()
                ->to('/centros-tech')
                ->with('msg', [
                    'type' => 'success',
                    'content' => 'Centro tech eliminado satisfactoriamente',
                ]);
        }
        
        return redirect()
            ->to('/centros-tech')
            ->with('msg', [
                'type' => 'danger',
                'content' => 'No se pudo eliminar el centro tech',
            ]);
    }

}
