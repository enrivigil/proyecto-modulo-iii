<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsuarioModel;
use App\Models\AccidenteModel;

class Reporte extends BaseController
{
    private function getReporteAccidente($datos) {
        $db = db_connect();
        $builder = $db->table('notificacion_accidentes');
        $builder->select('
            notificacion_accidentes.id,
            notificacion_accidentes.titulo,
            notificacion_accidentes.fecha_notificacion,
            estados_notificaion.nombre as \'estado\',
            tipos_accidente.nombre as \'tipo\',
            usuarios.nombre,
            usuarios.apellido,
            ');
        $builder->join('estados_notificaion', 'notificacion_accidentes.estado_notificacion_id = estados_notificaion.id', 'inner');
        $builder->join('tipos_accidente', 'notificacion_accidentes.tipo_accidente_id = tipos_accidente.id', 'inner');
        $builder->join('usuarios', 'notificacion_accidentes.usuario_id = usuarios.id', 'inner');

        if (!empty($datos['ta']))
            $builder->where('tipo_accidente_id', $datos['ta']);

        if (!empty($datos['ea']))
            $builder->where('estado_notificacion_id', $datos['ea']);

        if (!empty($datos['fi']) && !empty($datos['ff']))
            $builder->where([
                'fecha_notificacion >' => $datos['fi'],
                'fecha_notificacion <' => $datos['ff'],
            ]);

        if (!empty($datos['no']))
            $builder->where('usuario_id', $datos['no']);

        $query = $builder->get();
        $data = $query->getResult();
        $accidentes = json_decode(json_encode($data), true);

        return $accidentes;
    }

    private function getReporteDispositivo($datos) {
        $db = db_connect();
        $builder = $db->table('dispositivos');
        $builder->select('
            dispositivos.id,
            dispositivos.nombre,
            dispositivos.marca,
            dispositivos.modelo,
            dispositivos.num_serie,
            centros_tech.nombre as \'centrotech\',
            estados_dispositivo.nombre as \'estado\',
            ');
        $builder->join('centros_tech', 'dispositivos.centro_tech_id = centros_tech.id', 'inner');
        $builder->join('estados_dispositivo', 'dispositivos.estado_dispositivo_id = estados_dispositivo.id', 'inner');

        if (!empty($datos['ct']))
            $builder->where('centro_tech_id', $datos['ct']);

        if (!empty($datos['ed']))
            $builder->where('estado_dispositivo_id', $datos['ed']);

        $query = $builder->get();
        $data = $query->getResult();
        $dispositivos = json_decode(json_encode($data), true);

        return $dispositivos;
    }

    public function index()
    {
        $accidentes = '';
        $dispositivos = '';

        $reporte = $this->request->getVar('reporte');

        // para los accidentes
        $ta = $this->request->getVar('ta');  // tipo accidente
        $ea = $this->request->getVar('ea');  // estado accidente
        $fi = $this->request->getVar('fi');  // fecha inico
        $ff = $this->request->getVar('ff');  // fecha final
        $no = $this->request->getVar('no');  // notificador

        $filtrosAccidente = [
            'ta' => $ta,
            'ea' => $ea,
            'fi' => $fi,
            'ff' => $ff,
            'no' => $no,
        ];
        $accidentes = $this->getReporteAccidente($filtrosAccidente);

        // para los dispositivos
        $ct = $this->request->getVar('ct');  // centro tech
        $ed = $this->request->getVar('ed');  // estado dispositivo

        $filtrosDispositivo = [
            'ct' => $ct,
            'ed' => $ed,
        ];
        $dispositivos = $this->getReporteDispositivo($filtrosDispositivo);

        // para los accidentes
        $db = db_connect();
        $query = $db->query('call spListarEstadosAccidente()');
        $dataQuery = $query->getResult();
        $estados = json_decode(json_encode($dataQuery), true);
        $query = $db->query('call spListarTiposAccidentes()');
        $dataQuery = $query->getResult();
        $tipos = json_decode(json_encode($dataQuery), true);
        $model = model(UsuarioModel::class);
        $usuarios = $model->findAll();

        // para los dispositivos
        $query = $db->query('call spListarEstadosDispositivo()');
        $dataQuery = $query->getResult();
        $estadosDispositivo = json_decode(json_encode($dataQuery), true);
        $query = $db->query('call spListarCentrosTech()');
        $dataQuery = $query->getResult();
        $centrosTech = json_decode(json_encode($dataQuery), true);

        return view('reportes/index', [
            'modulo' => 'reporte',
            'reporte' => $reporte ?? 'accidente',
            'accidentes' => [
                'estadosaccidente' => $estados,
                'tiposaccidente' => $tipos,
                'usuarios' => $usuarios,
                'datos' => $accidentes,
                'filtros' => json_encode($filtrosAccidente),
            ],
            'dispositivos' => [
                'estadosdispositivo' => $estadosDispositivo,
                'centrostech' => $centrosTech,
                'datos' => $dispositivos,
                'filtros' => json_encode($filtrosDispositivo),
            ]
        ]);

    }
}
