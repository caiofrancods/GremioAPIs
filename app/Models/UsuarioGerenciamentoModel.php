<?php



namespace App\Models;
use CodeIgniter\Model;


class UsuarioGerenciamentoModel extends Model
{
  protected $table = 'Usuario';
  protected $primaryKey = ['codigo']; // Chave primária composta
  protected $allowedFields = ['cargo', 'senha', 'email', 'nome'];
  protected $DBGroup = 'dbGerenciamento';

  public function autenticar($usuario, $senha)
    {
        $senha = md5($senha . getenv('code_complementar'));

        $usuario = $this->where('email', $usuario)->first();

        if ($usuario && $senha == $usuario['senha']) {
            return $usuario;
        }


        return "erro";
    }

}