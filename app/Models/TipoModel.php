<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoModel extends Model
{
  protected $table = 'TipoDocumento';
  protected $primaryKey = 'id';
  protected $allowedFields = ['tipo'];
  protected $DBGroup = 'dbAssinatura';

  public function listarTipos()
  {
    return $this->findAll();
  }


}
