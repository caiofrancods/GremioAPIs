<?php
namespace App\Database\Migrations\assinatura;

use CodeIgniter\Database\Migration;

class Assinatura extends Migration
{
    protected $DBGroup = 'dbAssinatura';
    public function up()
    {
        // Tabela TipoDocumento
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('TipoDocumento');

        // Tabela Documento
        $this->forge->addField([
            'codigoDocumento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'horarioSubmissao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'situacao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'caminho' => [
                'type' => 'VARCHAR',

                'constraint' => '255',
            ],
            'tipo' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'acesso' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'comprovante' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('codigoDocumento');
        $this->forge->addForeignKey('tipo', 'TipoDocumento', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Documento');

        // Tabela DocumentoUsuario
        $this->forge->addField([
            'codUsuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'codigoDocumento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'horario' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'situacao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'mudanca' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey(['codUsuario', 'codigoDocumento']);
        $this->forge->addForeignKey('codigoDocumento', 'Documento', 'codigoDocumento', 'CASCADE', 'CASCADE');
        $this->forge->createTable('DocumentoUsuario');
    }

    public function down()
    {
        $this->forge->dropTable('DocumentoUsuario');
        $this->forge->dropTable('Documento');
        $this->forge->dropTable('TipoDocumento');
    }
}
