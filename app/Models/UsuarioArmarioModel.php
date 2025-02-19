<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioArmarioModel extends Model
{
    protected $table = 'Usuario';
    protected $primaryKey = 'idUsuario';
    protected $allowedFields = ['nome', 'telefone', 'email', 'dataNascimento', 'idCurso', 'ano', 'senha', 'recuperacao'];

    protected $DBGroup = 'default';

    public function getUsuarioPorId($idUsuario)
    {
        $user = $idUsuario ? $this->find($idUsuario) : $this->findAll();
        if(!$user){
            return false;
        }
        $user['senha'] = "Informação Confidencial";
        $user['recuperacao'] = "";
        return $user;
    }

    public function getRecuperacao($idUsuario)
    {
        $user = $idUsuario ? $this->find($idUsuario) : $this->findAll();
        return $user['recuperacao'];
    }
    
    public function getUsuarioPorEmail($email)
    {
      $user = $this->where('email', $email)->first();
      if(!$user){
          return false;
      }
      $user['senha'] = "Informação Confidencial";
      $user['recuperacao'] = "";
      return $user;
    }
    public function insertUsuario($data)
    {
        return $this->insert($data);
    }

    public function updateUsuario($id, $novaSenha)
    { 
      $senha = md5(string: $novaSenha . getenv('code_complementar'));
      return $this->update($id, ['senha' => $senha]);
    }
    public function setRecuperacao($id, $token)
    { 
      
        return $this->update($id, ['recuperacao' => $token]);
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
