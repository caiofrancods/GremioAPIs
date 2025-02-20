<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url(relativePath: 'assets/img/icon.png'); ?>">
  <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/estilo.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <title>Grêmio APIs</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" id="mainNav">
    <div class="container px-2 d-flex justify-content-center">
      <a href="index.php"><img class="img-fluid logo ml-4" src="<?php echo base_url('assets/img/logo.jpeg'); ?>"
          alt="logo do grêmio"></a>
      <a class="navbar-brand fw-bold" href="index.php">Grêmio APIs</a>
    </div>
  </nav>
  <div class="container">
    <div class="card mt-2">
      <div class="card-header text-center">
        Autenticação de Usuários
      </div>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[POST]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/armarios/auth/{email}/{senha}">api.gremiotimoteo.online/auth/armarios</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Autentica o usuário do banco de armários e retorna o token de acesso dele. O token é válido por <strong>1
                hora</strong></p>
            <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{
    "usuario": "usuarioEmail@gmail.com",
    "senha": "48da54c6a8029a8c1eea14cd715067a7"
}
</pre>
              </samp>
            </div>
            <p>Observação: A senha já deve ser enviada <strong>criptografada como md5</strong></p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
                  {
  "0": 200,
  "message": "Login autorizado!",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkV4ZW1wbG8iLCJhZG1pbiI6dHJ1ZSwiaWF0IjoxNzM5NTQyMjM5LCJleHAiOjE3Mzk1NDU4Mzl9.yT9fCFn4v-6T9ca66cfmRk0QEYKORcoSvwjSmyWIP48"
}
</pre>
              </samp>
            </div>
            <p>Para utilizar o token de acesso, envie como "authorization" o texto "Bearer &lttoken&gt"</p>
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[POST]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/armarios/auth/{email}/{senha}">api.gremiotimoteo.online/auth/gerencia</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Autentica o usuário do banco de gerenciamento e retorna o token de acesso dele. O token é válido por <strong>1
                hora</strong></p>
            <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{
    "usuario": "usuarioEmail@gmail.com",
    "senha": "48da54c6a8029a8c1eea14cd715067a7"
}
</pre>
              </samp>
            </div>
            <p>Observação: A senha já deve ser enviada <strong>criptografada como md5</strong></p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
                  {
  "0": 200,
  "message": "Login autorizado!",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkV4ZW1wbG8iLCJhZG1pbiI6dHJ1ZSwiaWF0IjoxNzM5NTQyMjM5LCJleHAiOjE3Mzk1NDU4Mzl9.yT9fCFn4v-6T9ca66cfmRk0QEYKORcoSvwjSmyWIP48"
}
</pre>
              </samp>
            </div>
            <p>Para utilizar o token de acesso, envie como "authorization" o texto "Bearer &lttoken&gt"</p>
            </p>
          </div>
        </div>

      </div>
      <div class="card-body">
      </div>
    </div>
    <div class="card mt-2">
      <div class="card-header text-center">
        Armários
      </div>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/armarios">api.gremiotimoteo.online/armarios</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>

          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna a lista de armários cadastrados no banco de dados.</p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{"message": [
    {
      "idArmario": "20",
      "codigo": "2P004",
      "dono": "9",
      "situacao": "2",
      "renovacao": "0",
      "comp": "Confidencial"
    }
    ...
]}
</pre>
              </samp>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/armarios/infousuario/{idUsuario}">api.gremiotimoteo.online/armarios/infousuario/{idUsuario}</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna um objeto com as informações do usuário</p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{"message": {
    "idUsuario": "85",
    "nome": "Caio Franco",
    "telefone": "(31) 98973-3616",
    "email": "francocaio80@gmail.com",
    "dataNascimento": "2007-01-26",
    "idCurso": "2",
    "ano": "3",
    "senha": "Informação Confidencial",
    "recuperacao": ""
  }
}
</pre>
              </samp>
            </div>
            <p>Observação: Informações restritras ao usuário, sendo necessário token de autenticação <strong>do usuário</strong></p>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/usuario/{idUsuario}">api.gremiotimoteo.online/armarios/usuario/{idUsuario}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Retorna um array com a lista de todos os armários que o usuário é proprietário.</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{"message": [
    {
      "idArmario": "118",
      "codigo": "1B002",
      "dono": "85",
      "situacao": "2",
      "renovacao": "0",
      "comp": "Confidencial"
    },
    {
      "idArmario": "119",
      "codigo": "1B006",
      "dono": "85",
      "situacao": "2",
      "renovacao": "0",
      "comp": "Confidencial"
    }
    ...
  ]
}
</pre>
                </samp>
              </div>
              <p>Observação: Informações restritras ao usuário, sendo necessário token de autenticação <strong>do usuário</strong></p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/usuario/solicitacao/alterarsenha/{emailUsuario}">api.gremiotimoteo.online/armarios/usuario/solicitacao/alterarsenha/{emailUsuario}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Envia o e-mail de recuperação de senha</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "E-mail de recuperação de senha enviado!"
}
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[POST]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/usuario/cadastrar">api.gremiotimoteo.online/armarios/usuario/cadastrar</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Cadastra o usuário</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
    "nome": "Fulano",
    "telefone": "(31) 98347-8238",
    "email": "fulano@gmail.com",
    "dataNascimento": "14/01/2012",
    "idCurso": 3,
    "ano": 2,
    "senha": "48da54c6a8029a8c1eea14cd715067a7"
}
</pre>
                </samp>
              </div>
              <p>Observação: A senha já deve ser enviada <strong>criptografada como md5</strong></p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
JSON que receb
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[PUT]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/usuario/alterarDados">api.gremiotimoteo.online/armarios/usuario/alterarDados</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Altera os dados do usuário</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
    "nome": "Fulano",
    "telefone": "(31) 98347-8238",
    "email": "fulano@gmail.com",
    "dataNascimento": "14/01/2012",
    "idCurso": 3,
    "ano": 2
}
</pre>
                </samp>
              </div>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
JSON de recebimento
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[PUT]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/usuario/alterarSenha">api.gremiotimoteo.online/armarios/usuario/alterarSenha</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Altera a senha do usuário</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
                  {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkV4ZW1wbG8iLCJhZG1pbiI6dHJ1ZSwiaWF0IjoxNzM5NTQyMjM5LCJleHAiOjE3Mzk1NDU4Mzl9.yT9fCFn4v-6T9ca66cfmRk0QEYKORcoSvwjSmyWIP48",
    "novaSenha": "teste123"
}
</pre>
                </samp>
              </div>
              <p>Observação: A senha não precisa estar criptografada md5</strong></p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "Senha alterada com sucesso."
}
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[PUT]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/armarios/transferir">api.gremiotimoteo.online/armarios/transferir</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Transfere a propriedade do armário de um usuário a outro.</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "remetente": "emailRemetente@gmail.com",
  "destinatario": "emailDestinatario@gmail.com",
  "armario": "1A015"
}
</pre>
                </samp>
              </div>
              <div class="row text-center"><I><strong>Retornos Possíveis</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "Transferência realizada com sucesso",
  "status": 200
}

ou

{
  "message": "Erro ao transferir o armário",
  "status": 400
}
</pre>
                </samp>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-bodycard p-3">
      </div>
    </div>

    <div class="card mt-2">
      <div class="card-header text-center">
        Assinaturas
      </div>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/assinatura/documentos">api.gremiotimoteo.online/assinatura/documentos</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna todos os documentos da base da dados</p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{
  "message": [
    {
      "codigoDocumento": "50",
      "nome": "Decreto 006/2024",
      "usuario": "15",
      "horarioSubmissao": "31/07/2024 16:05:57",
      "situacao": "Assinado",
      "caminho": "documentos/DECRETO DO GRÊMIO 006_2024.pdf",
      "tipo": "5",
      "acesso": "1",
      "comprovante": "skfekj"
    }
    ...
  ]
}
</pre>
              </samp>
            </div>
          </div>
          <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title"><a
                  href="api.gremiotimoteo.online/assinatura/documento/{codDocumento}">api.gremiotimoteo.online/assinatura/documento/{codDocumento}</a></span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna os dados a respeito do documento</p>
            <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
            <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
              <samp>
                <pre class="text-light">
{
  "message": {
    "codigoDocumento": "78",
    "nome": "Teste 1",
    "usuario": "2",
    "horarioSubmissao": "2025-02-15 01:50:19",
    "situacao": "Assinado",
    "caminho": "teste/1",
    "tipo": "1",
    "acesso": "1",
    "comprovante": "iendss"
  }
}
</pre>
              </samp>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/documentos/tipo/{idTipo}">api.gremiotimoteo.online/assinatura/documentos/tipo/{idTipo}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Retorna todos os documentos daquele tipo específico</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": [
    {
      "codigoDocumento": "43",
      "nome": "2° Reunião Ordinária do Conselho Fiscal",
      "usuario": "15",
      "horarioSubmissao": "31/07/2024 14:58:27",
      "situacao": "Cancelado",
      "caminho": "documentos/2° Reunião Ordinária do Conselho Fiscal.pdf",
      "tipo": "2",
      "acesso": "2",
      "comprovante": "mfrfsk"
    }
    ...
  ]
}

</pre>
                </samp>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/documentos/usuario/{idUsuario}">api.gremiotimoteo.online/assinatura/documentos/usuario/{idUsuario}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Retorna todos os documentos submetidos por aquele usuário</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": [
    {
      "codigoDocumento": "28",
      "nome": "Convocação 2° Reunião Ordinária do Conselho Fiscal",
      "usuario": "2",
      "horarioSubmissao": "30/04/2024 15:40:07",
      "situacao": "Assinado",
      "caminho": "documentos/Convocação Reunião Conselho Fiscal (1).pdf",
      "tipo": "6",
      "acesso": "2",
      "comprovante": "ksbfsj"
    }
    ...
  ]
}

</pre>
                </samp>
              </div>
              <p>Observação: Informações restritras ao usuário, sendo necessário token de autenticação <strong>do usuário</strong></p>
            </div>
          </div>

          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/validar/{codigoDocumento}/{comprovante}">api.gremiotimoteo.online/assinatura/validar/{codigoDocumento}/{comprovante}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Autentica o documento como assinado no sistema</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": [
    "codigoDocumento": "50",
    "nome": "Decreto 006/2024",
    "usuario": "15",
    "horarioSubmissao": "31/07/2024 16:05:57",
    "situacao": "Assinado",
    "caminho": "documentos/DECRETO DO GRÊMIO 006_2024.pdf",
    "comprovante": "FUNDPE",
    "tipo": "5",
    "acesso": "1"
  ]
}
</pre>
                </samp>
              </div>
              <p>Não é necessário token de autenticação</p>
            </div>
          </div>

          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/cancelar/{codigoDocumento}/{idUsuario}">api.gremiotimoteo.online/assinatura/cancelar/{codigoDocumento}/{idUsuario}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Cancela a submissão do documento. Observação: Um documento só pode ser cancelado
                se não foi assinado por nenhum dos signatários até o momento da requisição</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "Documento cancelado!"
}

ou

{
  "message": "Situação não alterada para os usuarios"
}

ou

{
  "message": "Documento não encontrado"
}
</pre>
                </samp>
              </div>
              <p>Observação: Informações restritras ao usuário, sendo necessário token de autenticação <strong>do usuário</strong></p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/assinar/{codigoDocumento}/{idUsuario}">api.gremiotimoteo.online/assinatura/assinar/{codigoDocumento}/{idUsuario}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Confirma a assinatura do usuário no documento</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "Assinatura Negada!"
}

ou

{
  "message": "Documento assinado por todos"
}

ou 

{
  "message": "Documento assinado pelo usuario"
}

ou 

{
  "message": "Falha ao assinar o documento"
}
</pre>
                </samp>
              </div>
              <p>Observação: Informações restritras ao usuário, sendo necessário token de autenticação <strong>do usuário</strong></p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href=">api.gremiotimoteo.online/assinatura/documentoUsuarios/{codigoDocumento}">api.gremiotimoteo.online/assinatura/documentoUsuarios/{codigoDocumento}</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Lista todas as informações da tabela DocumentoUsuario relacionada ao documento em específico</p>
              <div class="row text-center"><I><strong>Retorno JSON</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
                  {
  "message": [
    {
      "codUsuario": "2",
      "codigoDocumento": "78",
      "horario": "2025-02-15 01:50:19",
      "situacao": "Assinado",
      "mudanca": "15/02/2025 01:54:09"
    },
    {
      "codUsuario": "7",
      "codigoDocumento": "78",
      "horario": "2025-02-15 01:50:19",
      "situacao": "Assinado",
      "mudanca": "15/02/2025 01:54:13"
    }
  ]
}
</pre>
                </samp>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[GET]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/listarTipos">api.gremiotimoteo.online/assinatura/listarTipos</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Lista os tipos de documentos cadastrados no banco de dados
              </p>
              <div class="row text-center"><I><strong>JSON de
                    envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "message": "(Em breve) Tipos"
}
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[PUT]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/acesso">api.gremiotimoteo.online/assinatura/acesso</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Altera o tipo de visibilidade (acesso) do documento frente ao público</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I>
              </div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "novoAcesso": 2,
  "codigoDocumento": 50,
  "idUsuario": 2
}
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <div>
                <span class="accordion-title p-2">[POST]</span>
                <span class="accordion-title"><a
                    href="api.gremiotimoteo.online/assinatura/submissao">api.gremiotimoteo.online/assinatura/submissao</a></span>
              </div>
              <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
            </button>
            <div class="accordion-content" aria-hidden="true">
              <p>Submete um documento para assinatura</p>
              <div class="row text-center"><I><strong>JSON de envio</strong></I></div>
              <div class="row p-3 border m-3 mt-1 rounded bg-dark text-light">
                <samp>
                  <pre class="text-light">
{
  "nome": "Teste 1",
  "usuario": 2,
  "horarioSubmissao": "02/05/2024 10:44:11",
  "caminho": "teste/1",
  "tipo": 1,
  "acesso": 1,
  "signatarios": [2, 7]
}

{
  "message": "Documento do código 109 submetido"
}
</pre>
                </samp>
              </div>
            </div>
          </div>
          <div class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-2">
    <div class="card-header text-center">
      Gerenciamento
    </div>
    <div class="card-body">
    </div>
  </div>

  </div>
  </div>
  <script type="text/javascript">
    const items = document.querySelectorAll(".accordion button");

    function toggleAccordion() {
      const itemToggle = this.getAttribute('aria-expanded');

      for (let i = 0; i < items.length; i++) {
        items[i].setAttribute('aria-expanded', 'false');
        items[i].nextElementSibling.setAttribute('aria-hidden', 'true');
      }

      if (itemToggle === 'false') {
        this.setAttribute('aria-expanded', 'true');
        this.nextElementSibling.setAttribute('aria-hidden', 'false');
      }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));
  </script>
</body>

</html>