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
        Armários
      </div>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title">api.gremiotimoteo/armarios</span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna a lista de armários cadastrados no banco de dados</p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title">api.gremiotimoteo/armarios/{idArmario}</span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna as informações do armário</p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <div>
              <span class="accordion-title p-2">[GET]</span>
              <span class="accordion-title">api.gremiotimoteo/armarios/usuario/{idUsuario}</span>
            </div>
            <span class="icon bi bi-chevron-down" aria-hidden="true"></span>
          </button>
          <div class="accordion-content" aria-hidden="true">
            <p>Retorna um array com a lista de todos os armários que o usuário é proprietário</p>
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