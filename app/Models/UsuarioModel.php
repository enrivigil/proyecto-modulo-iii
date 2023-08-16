<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre',
        'apellido',
        'dui',
        'nombre_usuario',
        'email',
        'contrasenia',
        'activo',
        'rol_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nombre'     => 'required',
        'apellido'     => 'required',
        'dui'        => 'required|is_unique[usuarios.dui]',
        'nombre_usuario'        => 'required|is_unique[usuarios.nombre_usuario]',
        'email'        => 'required|valid_email|is_unique[usuarios.email]',
        'contrasenia'     => 'required|min_length[8]',
    ];
    protected $validationMessages   = [
        'nombre' => [
            'required' => 'El campo nombre es requerido',
        ],
        'apellido' => [
            'required' => 'El campo apellido es requerido',
        ],
        'dui' => [
            'required' => 'El campo dui es requerido',
            'is_unique' => 'Ups! Este DUI ya existe, utiliza otro',
        ],
        'nombre_usuario' => [
            'required' => 'El campo nombre de usuario es requerido',
            'is_unique' => 'Ups! Este NOMBRE DE USUARIO ya existe, utiliza otro',
        ],
        'email' => [
            'required' => 'El campo email es requerido',
            'is_unique' => 'Ups! Este EMAIL ya existe, utiliza otro',
        ],
        'contrasenia' => [
            'required' => 'Campo contraseña es requerido',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
