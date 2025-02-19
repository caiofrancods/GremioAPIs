<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('apis');
    }

    public function recuperacaoSenha(): string
    {
        return view('recuperacaoSenha');
    }
}
