<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MultiDBController extends ResourceController
{
    public function index()
    {
        // Conectar ao primeiro banco
        $db1 = \Config\Database::connect();
        $query1 = $db1->query("SELECT 'Conectado ao banco principal' AS msg");
        $result1 = $query1->getResult();

        // Conectar ao segundo banco
        // $db2 = \Config\Database::connect('db2');
        // $query2 = $db2->query("SELECT 'Conectado ao banco secundário' AS msg");
        // $result2 = $query2->getResult();

        return $this->respond([
            'db1' => $result1,
            //'db2' => $result2
        ]);
    }
}
