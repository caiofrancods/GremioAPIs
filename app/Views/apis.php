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
            <p>Para utilizar o token de acesso, envie como "authorization" o texto "Bearer  &lttoken&gt"</p>
            <p><strong>Todas as requisições que NÃO são de login, precisam de enviar o token para autenticação.</strong></p>
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
            <p><strong>Todas as requisições que NÃO são de login, precisam de enviar o token para autenticação.</strong>
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
    "senha": "Informação Confidencial"
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
    "email": "fulano@gmail.com",
    "novaSenha": "48da54c6a8029a8c1eea14cd715067a7"
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
        Gerenciamento
      </div>
      <div class="card-body">
      </div>
    </div>
    <div class="card mt-2">
      <div class="card-header text-center">
        Assinaturas
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