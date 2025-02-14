<?php

namespace App\Models;
use CodeIgniter\Model;


class DocumentoUsuarioModel extends Model
{
  protected $table = 'DocumentoUsuario';
  protected $primaryKey = 'codUsuario';
  protected $allowedFields = ['horario', 'situacao', 'mudanca'];
  protected $DBGroup = 'default';

  public function buscarSignatarios($codigo)
    {
        return $this->where('codigoDocumento', $codigo)->findAll();
    }

    public function buscarSignatariosPorId($codigo, $id)
    {
        return $this->where(['codigoDocumento' => $codigo, 'codUsuario' => $id])->first();
    }

    public function atualizarSituacao($codigoDocumento, $situacao)
    {
        $data = ['situacao' => $situacao, 'mudanca' => date('d/m/Y H:i:s')];
        $this->where('codigoDocumento', $codigoDocumento)->set($data)->update();
    }

    public function assinar($cod, $user)
    {
        $data = ['situacao' => 'Assinado', 'mudanca' => date('d/m/Y H:i:s')];
        $this->where(['codigoDocumento' => $cod, 'codUsuario' => $user])->set($data)->update();
    }

    public function contarSignatarios($cod)
    {
        return $this->where('codigoDocumento', $cod)->countAllResults();
    }

    public function contarAssinaturas($cod)
    {
        return $this->where(['codigoDocumento' => $cod, 'situacao' => 'Assinado'])->countAllResults();
    }

    public function verificarAssinatura($codUsuario, $codigoDocumento)
    {
        return $this->where(['codUsuario' => $codUsuario, 'codigoDocumento' => $codigoDocumento, 'situacao' => 'Assinado'])->countAllResults() > 0;
    }

}