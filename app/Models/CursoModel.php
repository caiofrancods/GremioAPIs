<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model
{
  protected $table = 'Curso';
  protected $primaryKey = 'idCurso';
  protected $allowedFields = ['descricao'];
  protected $DBGroup = 'default';

  public function listarCursos()
  {
    return $this->findAll();
  }


}
