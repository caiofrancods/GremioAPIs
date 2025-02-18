<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArmarioProdSeeder extends Seeder
{
  protected $DBGroup = 'default';
    public function run()
    {

        // Seed para Curso
        $cursos = [
            ['descricao' => 'Arquitetura'],
            ['descricao' => 'Desenvolvimento de Sistemas'],
            ['descricao' => 'Edificações'],
            ['descricao' => 'Eng. da Computação'],
            ['descricao' => 'Eng. Metalúrgica'],
            ['descricao' => 'Metalurgia'],
            ['descricao' => 'Química'],
        ];
        $this->db->table('Curso')->insertBatch($cursos);

    }
}