<?php

namespace App\Models;

use CodeIgniter\Model;

class ArmarioModel extends Model
{
    protected $table = 'Armario';
    protected $primaryKey = 'idArmario';
    protected $allowedFields = ['codigo', 'dono', 'situacao', 'aprovacao'];
    protected $DBGroup = 'default';

    public function getArmarioDono($idUsuario = null)
    {
        return $idUsuario ? $this->find($idUsuario) : $this->findAll();
    }

    public function transferirArmario($destinatarioEmail, $armarioId)
    {
        $usuario = $this->where('email', $destinatarioEmail)->first();
    
        if (!$usuario) {
            return false;
        }
    
        $builder = $this->db->table('armarios');
        return $builder->where('id', $armarioId)->update(['dono' => $usuario['id']]);
    }
}
