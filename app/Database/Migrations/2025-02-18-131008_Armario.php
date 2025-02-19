<?php
namespace App\Database\Migrations\armario;

use CodeIgniter\Database\Migration;

class Armario extends Migration
{
    protected $DBGroup = 'default';
    public function up()
    {
          // Tabela Curso
        $this->forge->addField([
            'idCurso' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
        ]);
        $this->forge->addPrimaryKey('idCurso');
        $this->forge->createTable('Curso');

        // Tabela Usuario
        $this->forge->addField([
            'idUsuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'dataNascimento' => [
                'type' => 'DATE',
                'null' => true
            ],
            'idCurso' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'ano' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'recuperacao' => [
              'type' => 'VARCHAR',
              'constraint' => '300',
              'null' => false
          ],
        ]);
        $this->forge->addPrimaryKey('idUsuario');
        $this->forge->addForeignKey('idCurso', 'Curso', 'idCurso', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Usuario');

        // Tabela Armario
        $this->forge->addField([
            'idArmario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true
            ],
            'dono' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'renovacao' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true
            ],
            'comprovante' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('idArmario');
        $this->forge->addForeignKey('dono', 'Usuario', 'idUsuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Armario');
    }

    public function down()
    {
        $this->forge->dropTable('Armario');
        $this->forge->dropTable('Usuario');
        $this->forge->dropTable('Curso');
        $this->forge->dropTable('Administrador');
    }
}
