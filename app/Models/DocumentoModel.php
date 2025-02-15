<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentoModel extends Model
{
  protected $table = 'Documento';
  protected $primaryKey = 'codigoDocumento';
  protected $allowedFields = ['nome', 'usuario', 'horarioSubmissao', 'situacao', 'caminho', 'tipo', 'acesso', 'comprovante'];
  protected $DBGroup = 'dbAssinatura';

  public function submissao($data)
  {
    $data['horarioSubmissao'] = date('d/m/Y H:i:s');
    $data['situacao'] = 'Pendente';
    return $this->insert($data);
  }
  public function documentos()
  {
    return $this->orderBy('horarioSubmissao', 'DESC')->findAll();
  }

  public function documentosPorTipo($tipoSelecionado)
  {
    return $this->where('tipo', $tipoSelecionado)->orderBy('horarioSubmissao', 'DESC')->findAll();
  }

  public function documentosPorUsuario($idUsuario)
  {
    return $this->where('usuario', $idUsuario)->orderBy('horarioSubmissao', 'DESC')->findAll();
  }
  // public function buscarDocumento($codigo)
  // {
  //     return $this->find($codigo);
  // }

  public function validacao($codigo, $comprovante)
  {
    return $this->where(['codigoDocumento' => $codigo, 'comprovante' => $comprovante])->first();
  }

  public function cancelarSubmissao($id)
  {
    try {
      $result = $this->update($id, ['situacao' => 'Cancelado']);
      return $result ? true : false;
    } catch (\Exception $e) {
      log_message('error', 'Erro ao cancelar submissão: ' . $e->getMessage());
      return false;
    }
  }

  public function mudarSituacao($codigoDocumento)
  {
    $comprovante = random_string('alnum', 6);
    $this->update($codigoDocumento, ['situacao' => 'Assinado', 'comprovante' => $comprovante]);
  }

  public function alterarAcesso($novoAcesso, $codigo)
  {
    try {
      $result = $this->update($codigo, ['acesso' => $novoAcesso]);
      return $result ? true : false;
    } catch (\Exception $e) {
      log_message('error', 'Erro ao cancelar submissão: ' . $e->getMessage());
      return false;
    }
    
  }

}