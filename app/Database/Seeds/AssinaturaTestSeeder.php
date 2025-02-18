<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssinaturaTestSeeder extends Seeder
{
  protected $DBGroup = 'dbAssinatura';
    public function run()
    {
      $documentoData = [
        [
            'nome' => 'Prestação de Contas',
            'usuario' => 1,
            'horarioSubmissao' => date('Y-m-d H:i:s'),
            'situacao' => 'Pendente',
            'caminho' => '/arquivos/contrato1.pdf',
            'tipo' => 5,
            'acesso' => 1,
            'comprovante' => 'nfkjes'
        ],
        [
            'nome' => 'Convocação',
            'usuario' => 2,
            'horarioSubmissao' => date('Y-m-d H:i:s'),
            'situacao' => 'Assinado',
            'caminho' => '/arquivos/convocacao.pdf',
            'tipo' => 2,
            'acesso' => 2,
            'comprovante' => 'bcueni'
        ],
        [
          'nome' => 'Ata Reunião',
          'usuario' => 2,
          'horarioSubmissao' => date('Y-m-d H:i:s'),
          'situacao' => 'Cancelado',
          'caminho' => '/arquivos/atareuniao.pdf',
          'tipo' => 1,
          'acesso' => 2,
          'comprovante' => 'bduddo'
      ],
    ];
    $this->db->table('Documento')->insertBatch($documentoData);

    // Inserir relação entre usuário e documento
    $documentoUsuarioData = [
        [
            'codUsuario' => 1,
            'codigoDocumento' => 1,
            'horario' => date('Y-m-d H:i:s'),
            'situacao' => 'Pendente',
            'mudanca' => ""
        ],
        [
            'codUsuario' => 2,
            'codigoDocumento' => 1,
            'horario' => date('Y-m-d H:i:s'),
            'situacao' => 'Assinado',
            'mudanca' => date('Y-m-d H:i:s')
        ],
        [
          'codUsuario' => 1,
          'codigoDocumento' => 2,
          'horario' => date('Y-m-d H:i:s'),
          'situacao' => 'Assinado',
          'mudanca' => date('Y-m-d H:i:s')
      ],
      [
        'codUsuario' => 2,
        'codigoDocumento' => 3,
        'horario' => date('Y-m-d H:i:s'),
        'situacao' => 'Cancelado',
        'mudanca' => date('Y-m-d H:i:s')
      ],
    ];
    $this->db->table('DocumentoUsuario')->insertBatch($documentoUsuarioData);
    }
}
