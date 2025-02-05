<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class HelloController extends ResourceController
{
    public function index()
    {
        return $this->respond(['message' => 'Hello World'], 200);
    }
}
