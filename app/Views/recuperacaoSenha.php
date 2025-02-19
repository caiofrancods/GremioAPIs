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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Recuperação de Senha</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" id="mainNav">
    <div class="container px-2 d-flex justify-content-center">
      <img class="img-fluid logo ml-4" src="<?php echo base_url('assets/img/logo.jpeg'); ?>" alt="logo do grêmio">
      <a class="navbar-brand fw-bold" href="index.php">Recuperação de Senha</a>
    </div>
  </nav>
  <div class="corpo mt-4">
    <div>
      <form id="#formularioRecuperacao" class="mt-4">
        <?php if (isset($_GET['token']) && isset($_GET['sistema'])) {
          echo '<input type="text" id="token" name="token" class="d-none" value="' . htmlspecialchars($_GET['token']) . '">';
          echo '<input type="text" id="sistema" name="sistema" class="d-none" value="' . htmlspecialchars($_GET['sistema']) . '">';
        }else{
          echo '<input type="text" id="token" name="token" class="d-none" value="">';
          echo '<input type="text" id="sistema" name="sistema" class="d-none" value="">';
        }
        ?>
        <div class="form-row mt-3 d-flex justify-content-center">
          <div class="form-group col-md-6 text-center">
            <label for="senha">Insira a nova senha</label>
            <input type="text" id="senha" name="senha" class="form-control" required>
          </div>
        </div>
        <div class="form-row d-flex justify-content-center">
          <button type="button" onclick="enviarSenha()" class="btn btn-success">Alterar</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
    function enviarSenha() {
      var senha = document.getElementById("senha").value;
      var token = document.getElementById("token").value;
      var sistema = document.getElementById("sistema").value;
      if(token == "" || sistema == ""){
        alert('Erro na URL')
      }else{
      // Sistema 1 = Registro de Armários
      // Sistema 2 = Gerenciamento
      if(sistema == 1){
        if (token) {
        $.ajax({
          url: 'http://localhost:8080/armarios/usuario/alterarSenha',
          type: 'PUT',
          data: {
            novaSenha: senha,
            token: token
          },
          dataType: 'json',
        })
          .done(function (resultado) {
            if (resultado && resultado.status === 'Senha alterada com sucesso.') {
              alert('Senha alterada!');
            } else {
              alert('Senha não alterada! ');
            }
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
            alert('Erro na requisição: ' + textStatus + ' - ' + errorThrown);
            console.error("Erro na requisição AJAX:", jqXHR, textStatus, errorThrown); 
          });
      } else {
        alert('Token inválido.');
      }
      }else if(sistema == 2){
        alert('Não configurado!');
      }
      }     
    }
  </script>
</body>

</html>