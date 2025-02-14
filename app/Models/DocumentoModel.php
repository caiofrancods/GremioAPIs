<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentoModel extends Model
{
  protected $table = 'Documento';
  protected $primaryKey = 'codigoDocumento';
  protected $allowedFields = ['nome', 'usuario', 'horarioSubmissao', 'situacao', 'caminho', 'tipo', 'acesso', 'comprovante'];
  protected $DBGroup = 'default';

  public function submissao($data)
    {
        $data['horarioSubmissao'] = date('d/m/Y H:i:s');
        $data['situacao'] = 'Pendente';
        return $this->insert($data);
    }



    public function listar()
    {
        return $this->orderBy('horarioSubmissao', 'DESC')->findAll();
    }

    public function filtrarPorTipo($tipoSelecionado)
    {
        return $this->where('tipo', $tipoSelecionado)->orderBy('horarioSubmissao', 'DESC')->findAll();
    }

    public function buscarDocumento($codigo)
    {
        return $this->find($codigo);
    }

    public function buscarVerificacao($codigo, $comprovante)
    {
        return $this->where(['codigoDocumento' => $codigo, 'comprovante' => $comprovante])->first();
    }

    public function cancelarSubmissao($id)
    {
        $this->update($id, ['situacao' => 'Cancelado']);
        $documentoUsuarioModel = new DocumentoUsuarioModel();
        $documentoUsuarioModel->atualizarSituacao($id, 'Cancelado');
    }

    public function mudarSituacao($codigoDocumento)
    {
        $comprovante = random_string('alnum', 6);
        $this->update($codigoDocumento, ['situacao' => 'Assinado', 'comprovante' => $comprovante]);
    }

    public function alterarAcesso($novoAcesso, $codigo)
    {
        $this->update($codigo, ['acesso' => $novoAcesso]);
    }
  
}