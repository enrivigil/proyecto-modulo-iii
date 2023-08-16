<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;

class Usuario extends BaseController
{
    public function index()
    {
        try {

            $model = model(UsuarioModel::class);
            $usuarios = $model->findAll();

            return view('usuarios/index', [
                'usuarios' => $usuarios,
                'modulo' => 'administracion',
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function detalles($id)
    {
        try {

            $model = model(UsuarioModel::class);
            $usuario = $model->find($id);

            return view('usuarios/detalles', [
                'usuario' => $usuario,
                'modulo' => 'administracion',
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function agregar() {

        if ($this->request->getMethod() == 'post') {

            $model = model(UsuarioModel::class);

            $nombre = $this->request->getPost('nombre');
            $apellido = $this->request->getPost('apellido');
            $dui = $this->request->getPost('dui');
            $nombre_usuario = $this->request->getPost('nombre_usuario');
            $email = $this->request->getPost('email');
            $contrasenia = $this->request->getPost('contrasenia');
            $activo = true;
            $rol_id = $this->request->getPost('rol_id');

            $pass = password_hash($contrasenia, PASSWORD_BCRYPT);

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dui' => $dui,
                'nombre_usuario' => $nombre_usuario,
                'email' => $email,
                'contrasenia' => $pass,
                'activo' => $activo,
                'rol_id' => $rol_id,
            ];

            if ($model->insert($data)) {
                return redirect()->to('/usuarios/agregar')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Usuario agregado satisfactoriamente',
                    ]);
            }

            $rolModel = model(RolModel::class);
            $roles = $rolModel->findAll();

            return view('usuarios/agregar', [
                    'errors' => $model->errors(),
                    'roles' => $roles
                ]);
        }

        $rolModel = model(RolModel::class);
        $roles = $rolModel->findAll();

        return view('usuarios/agregar', [
            'roles' => $roles,
            'modulo' => 'administracion',
        ]);
    }

    public function editar($id) {

        $model = model(UsuarioModel::class);

        if ($this->request->getMethod() == 'post') {

            $usuarioId = $this->request->getPost('id');
            $nombre = $this->request->getPost('nombre');
            $apellido = $this->request->getPost('apellido');
            $activo = $this->request->getPost('activo');
            $rol_id = $this->request->getPost('rol_id');

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'activo' => $activo,
                'rol_id' => $rol_id,
            ];

            if ($model->update($usuarioId, $data)) {
                return redirect()->to('/usuarios')
                    ->with('msg', [
                        'type' => 'success',
                        'content' => 'Usuario editado satisfactoriamente',
                    ]);
            }

            // return redirect()->to('/usuarios/editar/' . $usuarioId);
            $rolModel = model(RolModel::class);
            $roles = $rolModel->findAll();
            $usuario = $model->find($id);

            return view('usuarios/editar', [
                    'errors' => $model->errors(),
                    'roles' => $roles,
                    'usuario' => $usuario,
                    'modulo' => 'administracion',
                ]);
        }

        $rolModel = model(RolModel::class);

        $roles = $rolModel->findAll();
        $usuario = $model->find($id);

        return view('usuarios/editar', [
            'usuario' => $usuario,
            'roles' => $roles,
            'modulo' => 'administracion',
        ]);
    }

    public function eliminar($id) {

        $model = model(UsuarioModel::class);

        if ($model->delete($id)) {
            return redirect()
                ->to('/usuarios')
                ->with('msg', [
                    'type' => 'success',
                    'content' => 'Usuario eliminado satisfactoriamente',
                ]);
        }
        
        return redirect()
            ->to('/usuarios')
            ->with('msg', [
                'type' => 'danger',
                'content' => 'No se pudo eliminar el usuario',
            ]);
    }

    public function cambiarContrasenia() {

        $model = model(UsuarioModel::class);

        $id = $this->request->getPost('id');
        $contrasenia = $this->request->getPost('contrasenia');

        $pass = password_hash($contrasenia, PASSWORD_BCRYPT);

        $data = [
            'contrasenia' => $pass,
        ];

        if ($model->update($id, $data)) {
            return redirect()
                ->to('/usuarios')
                ->with('msg', [
                    'type' => 'success',
                    'content' => 'Contraseña restablecida',
                ]);
        }

        return redirect()
            ->to('/usuarios')
            ->with('msg', [
                'type' => 'danger',
                'content' => 'No se puedo restablecer la contraseña',
            ]);
    }
}
