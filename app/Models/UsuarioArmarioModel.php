<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioArmarioModel extends Model
{
    protected $table = 'Usuario';
    protected $primaryKey = 'idUsuario';
    protected $allowedFields = ['nome', 'telefone', 'email', 'dataNascimento', 'idCurso', 'ano', 'senha'];

    protected $DBGroup = 'default';

    public function getUsuarioPorId($idUsuario)
    {
        return $idUsuario ? $this->find($idUsuario) : $this->findAll();
    }

    public function insertUsuario($data)
    {
        return $this->insert($data);
    }

    public function updateUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    public function autenticar($usuario, $senha)
    {
        $usuario = $this->where('email', $usuario)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return "erro";
    }
}
