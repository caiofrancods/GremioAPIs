<?php



namespace App\Models;
use CodeIgniter\Model;


class DocumentoUsuarioModel extends Model
{
  protected $table = 'DocumentoUsuario';
  protected $primaryKey = ['codUsuario']; // Chave primária composta
  protected $allowedFields = ['codigoDocumento', 'horario', 'situacao', 'mudanca'];
  protected $DBGroup = 'dbAssinatura';

  public function documentoUsuarios($codigoDocumento)
  {
    $this->output->enable_profiler(TRUE);
    try {
      $result = $this->where('codigoDocumento', $codigoDocumento)->findAll();
      return $result;
    } catch (\Exception $e) {
      log_message('error', 'Erro ao cancelar submissão: ' . $e->getMessage());
      return false;
    }
    
  }
  public function atualizarSituacao($codigoDocumento, $situacao)
  {
    try {
      $data = ['situacao' => $situacao, 'mudanca' => date('d/m/Y H:i:s')];
      $result = $this->where('codigoDocumento', $codigoDocumento)->set($data)->update();
      return $result ? true : false;
    } catch (\Exception $e) {
      log_message('error', 'Erro ao cancelar submissão: ' . $e->getMessage());
      return false;
    }
  }

  public function criarAssinatura($data)
  {
    return $this->insert($data);
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