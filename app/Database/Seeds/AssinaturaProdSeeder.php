<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssinaturaProdSeeder extends Seeder
{
  protected $DBGroup = 'dbAssinatura';
    public function run()
    {
      $tipoDocumentoData = [
        ['tipo' => 'Ata'],
        ['tipo' => 'Convocação'],
        ['tipo' => 'Documentos de Gestão'],
        ['tipo' => 'Ofício'],
        ['tipo' => 'Prestação de Contas'],
        ['tipo' => 'Registro de Movimentação Financeira'],
        ['tipo' => 'Solicitação de Verba'],
        ['tipo' => 'Outro'],
    ];
    $this->db->table('TipoDocumento')->insertBatch($tipoDocumentoData);
    }
}
