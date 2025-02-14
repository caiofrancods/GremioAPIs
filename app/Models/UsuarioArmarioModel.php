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
        $user = $idUsuario ? $this->find($idUsuario) : $this->findAll();
        if(!$user){
            return false;
        }
        $user['senha'] = "Informação Confidencial";
        return $user;
    }
    
    public function getUsuarioPorEmail($email)
    {
        return $this->where('email', $email)->first();
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
        $senha = md5($senha . getenv('code_complementar'));

        $usuario = $this->where('email', $usuario)->first();

        if ($usuario && $senha == $usuario['senha']) {
            return $usuario;
        }


        return "erro";
    }
}
