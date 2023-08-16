<?php

namespace App\Controllers;

use App\Models\AccidenteModel;
use App\Models\CentroTechModel;
use App\Models\DispositivoModel;

class Accidente extends BaseController
{
    public function index()
    {
        $model = model(AccidenteModel::class);
        $data = [];

        $db = db_connect();

        if (session()->get('rol_id') == 1) {
            $query = $db->query('call spListarAccidentes()');
            $data = $query->getResult();
        } else {
            $id = session()->get('usuario_id');
            $query = $db->query("call spListarMisAccidenteNotificados($id)");
            $data = $query->getResult();
        }
        $accidentes = json_decode(json_encode($data), true);

        $query = $db->query("call spListarEstadosAccidente()");
        $data = $query->getResult();
        
        $estados = json_decode(json_encode($data), true);

        return view('accidentes/index', [
            'modulo' => 'accidentes',
            'accidentes' => $accidentes,
            'estados' => $estados,
        ]);
    }

    public function detalles($id) {

        $db = db_connect();
        $query = $db->query("call spDetallesAccidente($id)");
        $data = $query->getResult();

        $accidente = json_decode(json_encode($data), true);

        return view('accidentes/detalles', [
            'modulo' => 'accidentes',
            'accidente' => $accidente[0],
        ]);
    }

    public function obtenerDispositivosPorCentroTech($centroTechId) {
        $model = model(DispositivoModel::class);
        $dispositivos = $model->where('centro_tech_id', $centroTechId)->findAll();
        echo json_encode($dispositivos);
    }

    public function agregar() {

        $centrosTechModel = model(CentroTechModel::class);
        $db = db_connect();
        $query = $db->query("call spListarTiposAccidentes()");
        $data = $query->getResult();

        if ($this->request->getMethod() == 'post') {

            $model = model(AccidenteModel::class);

            $validacion = [
                'titulo' => 'required',
                'descripcion' => 'required',
                'dispositivo_id' => 'required',
                'foto' => 'uploaded[foto]'
                    . '|is_image[foto]'
                    . '|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[foto,1000]'
                    . '|max_dims[foto,1024,768]',
            ];

            $mensajesValidacion = [
                'titulo' => ['required' => 'Titulo es requerido',],
                'descripcion' => ['required' => 'Descripcion es requerido',],
                'dispositivo_id' => ['required' => 'Dispositivo es requerido',],
                'foto' => [
                    'uploaded' => 'Foto de evidencia es requerido',
                    'is_image' => 'Foto de evidencia es tiene que ser una imagen',
                    'mime_in' => 'Foto de evidencia debe tener los siguientes formatos: image/jpg,image/jpeg,image/gif,image/png,image/webp',
                    'max_size' => 'Foto de evidencia debe pesar maximo de 1mb',
                    'max_dims' => 'Foto de evidencia debe tener meno de 1024,768 de dimension',
                ],
            ];

            if (!$this->validate($validacion, $mensajesValidacion)) {

                $centrosTech = $centrosTechModel->findAll();
                $tiposAccidentes = json_decode(json_encode($data), true);

                return view('accidentes/agregar', [
                    'modulo' => 'accidentes',
                    'tiposAccidentes' => $tiposAccidentes,
                    'centrosTech' => $centrosTech,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $titulo = $this->request->getPost('titulo');
            $descripcion = $this->request->getPost('descripcion');
            $tipo_accidente_id = $this->request->getPost('tipo_accidente_id');
            $dispositivo_id = $this->request->getPost('dispositivo_id');

            date_default_timezone_set('America/El_Salvador');
            $fecha_notificacion = date('Y-m-d H:i:s');
            $estado_notificacion_id = 1;
            $usuario_id = session()->get('usuario_id');

            $file = $this->request->getFile('foto');
            $fileName = $file->getRandomName();

            $absolutePath = ROOTPATH . 'public/uploads';
            $ruta = '';

            if ($file->move($absolutePath, $fileName)) {
                $ruta = 'uploads/' . $fileName;
            }


            $data = [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'tipo_accidente_id' => $tipo_accidente_id,
                'dispositivo_id' => $dispositivo_id,
                'fecha_notificacion' => $fecha_notificacion,
                'estado_notificacion_id' => $estado_notificacion_id,
                'foto' => $ruta,
                'usuario_id' => $usuario_id,
            ];

            if ($model->insert($data)) {
                return redirect()->to('/accidentes/agregar')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Notificacion de accidente agregado satisfactoriamente',
                    ]);
            }

            return redirect()->to('/accidentes/agregar')
                ->with('msg', [
                    'type' => 'danger',
                    'content' => 'No se puedo guardar los datos',
                ]);

        }

        $centrosTech = $centrosTechModel->findAll();
        $tiposAccidentes = json_decode(json_encode($data), true);

        return view('accidentes/agregar', [
            'modulo' => 'accidentes',
            'tiposAccidentes' => $tiposAccidentes,
            'centrosTech' => $centrosTech,
        ]);

    }

    public function resolucion($id) {

        $model = model(AccidenteModel::class);

        if ($this->request->getMethod() == 'post') {

            $validacion = [
                'resolucion' => 'required',
                'foto_res' => 'uploaded[foto_res]'
                    . '|is_image[foto_res]'
                    . '|mime_in[foto_res,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[foto_res,1000]'
                    . '|max_dims[foto_res,1024,768]',
            ];

            $mensajesValidacion = [
                'resolucion' => ['required' => 'Resolucion es requerido',],
                'foto_res' => [
                    'uploaded' => 'Foto de evidencia es requerido',
                    'is_image' => 'Foto de evidencia es tiene que ser una imagen',
                    'mime_in' => 'Foto de evidencia debe tener los siguientes formatos: image/jpg,image/jpeg,image/gif,image/png,image/webp',
                    'max_size' => 'Foto de evidencia debe pesar maximo de 1mb',
                    'max_dims' => 'Foto de evidencia debe tener meno de 1024,768 de dimension',
                ],
            ];

            if (!$this->validate($validacion, $mensajesValidacion)) {

                $accidente = $model->find($id);

                return view('accidentes/resolucion', [
                    'modulo' => 'accidentes',
                    'accidente' => $accidente,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $id = $this->request->getPost('id');
            $resolucion = $this->request->getPost('resolucion');
            $estado_notificacion_id = 4;

            date_default_timezone_set('America/El_Salvador');
            $fecha_resolucion = date('Y-m-d H:i:s');

            $file = $this->request->getFile('foto_res');
            $fileName = $file->getRandomName();

            $absolutePath = ROOTPATH . 'public/uploads';
            $ruta = '';

            if ($file->move($absolutePath, $fileName)) {
                $ruta = 'uploads/' . $fileName;
            }

            $data = [
                'resolucion' => $resolucion,
                'foto_res' => $ruta,
                'fecha_resolucion' => $fecha_resolucion,
                'estado_notificacion_id' => $estado_notificacion_id,
            ];

            if ($model->update($id, $data)) {

                return redirect()->to('/accidentes')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Accidente editado satisfactoriamente',
                    ]);

            }

            return redirect()->to('/accidentes')
                ->with('msg', [
                    'type' => 'danger',
                    'content' => 'No se puedo editar el accidente',
                ]);

        }

        $accidente = $model->find($id);

        return view('accidentes/resolucion', [
            'modulo' => 'accidentes',
            'accidente' => $accidente,
        ]);
    }

    public function cambiarEstado() {

        if ($this->request->getMethod() == 'post') {

            $model = model(AccidenteModel::class);

            $id = $this->request->getPost('id');
            $estado_id = $this->request->getPost('estado_id');

            $data = [
                'estado_notificacion_id' => $estado_id
            ];

            if ($model->update($id, $data)) {

                return redirect()->to('/accidentes')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Estado de accidente cambiado satisfactoriamente',
                    ]);

            }

            return redirect()->to('/accidentes')
                ->with('msg', [
                    'type' => 'danger',
                    'content' => 'No se puedo editar el estado de la notificacion',
                ]);

        }

    }
}
