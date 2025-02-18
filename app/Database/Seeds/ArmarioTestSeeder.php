<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArmarioTestSeeder extends Seeder
{
  protected $DBGroup = 'default';
    public function run()
    {

        // // Seed para Usuario
        $usuarios = [
            [
                'nome' => 'Usuário 1',
                'telefone' => '11999999999',
                'email' => 'usuario1@exemplo.com',
                'dataNascimento' => '2000-01-01',
                'idCurso' => 3, 
                'ano' => 2023,
                'senha' => md5(md5('senha123') . getenv('code_complementar')),
            ],
            [
                'nome' => 'Usuário 2',
                'telefone' => '11988888888',
                'email' => 'usuario2@exemplo.com',
                'dataNascimento' => '2001-02-02',
                'idCurso' => 3,
                'ano' => 2022,
                'senha' => md5(md5('senha123') . getenv('code_complementar')),

            ],
             [
                'nome' => 'Usuário 3',
                'telefone' => '11977777777',
                'email' => 'usuario3@exemplo.com',
                'dataNascimento' => '2002-03-03',
                'idCurso' => 2,
                'ano' => 2021,
                'senha' => md5(md5('senha123') . getenv('code_complementar')),
            ],
        ];
        $this->db->table('Usuario')->insertBatch($usuarios);

        // Seed para Armario
        $armarios = [
            [
                'codigo' => '2G001',
                'dono' => 1,
                'renovacao' => 0, 
                'comprovante' => "hdjvrk", 
            ],
             [
                'codigo' => '1A002',
                'dono' => 2,
                'renovacao' => 0, 
                'comprovante' => "bdb639", 
            ],
             [
                'codigo' => '3S003',
                'dono' => 3,
                'renovacao' => 0, 
                'comprovante' => "jcrkrdk",
            ],
        ];
        $this->db->table('Armario')->insertBatch(set: $armarios);
    }
}