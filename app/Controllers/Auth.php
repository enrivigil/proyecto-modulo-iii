<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() == 'post') {

            $model = model(UsuarioModel::class);
            $msg = ['type' => 'danger', 'content' => 'Usuario no existe'];

            $validacion = [
                'email' => 'required',
                'password' => 'required',
            ];

            $mensajesValidacion = [
                'email' => ['required' => 'Email requerido',],
                'password' => ['required' => 'Contraseña requerida',],
            ];

            if (!$this->validate($validacion, $mensajesValidacion)) {
                return view('auth/login', [
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $model->where('email', $email)->first();

            if (isset($user)) {

                if (!$user['activo'])
                    return redirect()->to('/login')->with('msg', [
                        'type' => 'danger',
                        'content' => 'Usuario bloqueado'
                    ]);

                $hashedPassword = $user['contrasenia'];
                $passwordVerified = password_verify($password, $hashedPassword);

                if ($passwordVerified) {

                    $userLogged = [
                        'usuario_id' => $user['id'],
                        'rol_id' => $user['rol_id'],
                        'nombre' => $user['nombre'],
                        'apellido' => $user['apellido'],
                        'isLogged' => true,
                    ];

                    session()->set($userLogged);
                    $msg = ['type' => 'success', 'content' => 'Usuario logueado correctamente!'];

                    return redirect()->to('/dashboard')
                        ->with('msg', $msg);
                }
                else {
                    $msg = ['type' => 'danger', 'content' => 'La contraseña es incorrecta'];
                }

            }

            return redirect()->to('/login')
                ->with('msg', $msg);

        }

        return view('auth/login');
    }

    public function logout() {

        session()->destroy();
        return redirect()->to('/login');

    }
}
