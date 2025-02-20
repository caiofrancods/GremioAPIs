<?php

namespace App\Models;

use CodeIgniter\Model;

class ArmarioModel extends Model
{
  protected $table = 'Armario';
  protected $primaryKey = 'idArmario';
  protected $allowedFields = ['codigo', 'dono', 'situacao', 'renovacao', 'comprovante'];
  protected $DBGroup = 'default';

  public function getArmarios($id = null)
  {
    $armarios = $id ? $this->find($id) : $this->findAll();

    if (is_array($armarios)) {
      foreach ($armarios as &$armario) {
        $armario['comprovante'] = 'Confidencial';
      }
    } elseif (is_array($armarios)) { // Caso retorne um único registro
      $armarios['comprovante'] = 'Confidencial';
    }

    return $armarios;
  }

  public function getArmarioDono($dono = null)
  {
    return $dono ? $this->where('dono', $dono)->findAll() : $this->findAll();
  }

  public function transferirArmario($remetenteEmail, $destinatarioEmail, $armarioCodigo)
  {
    $usuarioModel = new UsuarioArmarioModel();

    $usuarioRemetente = $usuarioModel->getUsuarioPorEmail($remetenteEmail);
    if (!$usuarioRemetente) {
      return false;
    }

    $armario = $this->where('codigo', $armarioCodigo)->first();
    if (!$armario) {
      return false;
    }

    if ($armario['dono'] != $usuarioRemetente['idUsuario']) {
      return false;
    }

    $usuarioDest = $usuarioModel->getUsuarioPorEmail($destinatarioEmail);
    if (!$usuarioDest) {
      return false;
    }



    return $this->where('idArmario', $armario['idArmario'])
      ->set(['dono' => $usuarioDest['idUsuario']])
      ->update();
  }

  public function validacao($codigo, $comprovante)
  {
    $armario = $this->where(['codigo' => $codigo, 'comprovante' => $comprovante])->first();

    if (!$armario) {
      return false;
    }
    $arm['codigo'] = $armario['codigo'];
    $arm['dono'] = $armario['dono'];
    return $arm;
  }


}
