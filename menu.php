<style>
  .liMenu {
    width: 150px;
    margin-left: -40px;
    border-radius: none;
  }

  .spanColor {
    color: #ffcd00;
  }

  li {
    list-style-type: none;
  }

  details li {
    -webkit-transition: all 0.2s ease;
    transition: all 0.5s ease;
  }

  details li:hover {
    -webkit-transform: scale(1.2);
    transform: scale(1.17);
  }

  .esconder-menu {
    display: none;
  }

  .openFullScreen {
    cursor: zoom-in;
  }

  .closeFullscreen {
    cursor: zoom-out;
  }
</style>

<!-- Sidebar -->
<div class="div esconder-menu">
  <div class="bg-light border-right" id="sidebar-wrapper">

    <div class="sidebar-heading">
      <a>
        <img src="images/logo_prefeitura.jpg" width="80" style="margin-top: 20px;" class="img-responsive text-center" alt="Logo Prefeitura">
      </a>
    </div>

    <div class="list-group list-group-flush">
      <!-- <a href="<?php echo $url ?>logistica/index.php" class="list-group-item list-group-item-action text-white bg-dark" rel="nofollow">Cadastro Rápido</a> -->

      <li><a href="#" class="list-group-item list-group-item-action bg-light">Menu</a></li>

      <!-- <li><a href="motorista.php" class="list-group-item list-group-item-action bg-light">Motoristas</a></li>

      <li><a href="transportadora.php" class="list-group-item list-group-item-action bg-light">Transportadoras</a></li>

      <li><a href="tp_documento.php" class="list-group-item list-group-item-action bg-light">Docs Frota</a></li> -->

      <?php
      // if (!isset($_SESSION["nivel"])) { ?>
      <!-- //   <li><a href="financeiro_total.php" class="list-group-item list-group-item-action bg-light">Financeiro Carretas</a></li>

      //   <li>
      //     <a href="financeiro.php" class="list-group-item list-group-item-action bg-light">Financeiro</a>
      //   </li>

      //   <li>
      //     <a href="relatorio_clientes.php" class="list-group-item list-group-item-action bg-light">Clientes</a>
      //   </li>

      //   <details>
      //     <summary class="list-group-item list-group-item-action bg-light">Pneus</summary>
      //     <li>
      //       <a href="pneus.php" class="list-group-item list-group-item-action bg-light">
      //         <strong>Pneus</strong>
      //       </a>
      //     </li>

      //     <li>
      //       <a href="pneus_relatorio.php" class="list-group-item list-group-item-action bg-light">
      //         <strong>Pneus/Equipamento</strong>
      //       </a>
      //     </li>

      //     <li>
      //       <a href="pneus_gerais.php" class="list-group-item list-group-item-action bg-light">
      //         <strong>Visão Geral</strong>
      //       </a>
      //     </li>
      //   </details>

      //   <li><a href="dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a></li>

      //   <li><a href="estatistica.php" class="list-group-item list-group-item-action bg-light">REM</a></li>

      //   <li><a href="diarias.php" class="list-group-item list-group-item-action bg-light">Diárias</a></li> -->
      <?php
      // } ?>
    </div>
  </div>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->

<div id="page-content-wrapper">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <button class="btn btn-light teste" id="menu-toggle"> <strong>Exibir</strong> </button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0 float-right">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <?php
            if (!$sock = @fsockopen('www.google.com.br', 80, $num, $error, 5)) echo '<span style="color:red; font-size:18px;" class="ml-3"><i title="INTERNET OFF" class="glyphicon glyphicon-globe"></i></span>';
            else echo '<span style="color:#01ff1f;  font-size:16px;" class="ml-3"><i title="INTERNET ON" class="glyphicon glyphicon-globe"></i></span>'; ?> <span class="sr-only">(current)</span>
          </a>
        </li>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#" onClick="openFullscreen()" class="openFullScreen">
              <i class="glyphicon glyphicon-fullscreen text-white"></i>
            </a>
          </li>

          <li>
            <a href="#" onClick="closeFullscreen()" class="closeFullscreen">
              <i class="glyphicon glyphicon-resize-small text-white"></i>
            </a>
          </li>

          <!-- <li>
            <a href="#" data-toggle="tooltip" data-placement="bottom" title="">
              <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['usuarioNome']; ?>
            </a>
          </li> -->

          <li>
            <a href="processamento/logout.php">
              <span class="glyphicon glyphicon-log-in"></span> Sair
            </a>
          </li>
        </ul>
      </ul>
    </div>
  </nav>

  <!-- JavaScript para minimizar o menu -->
  <script>
    // seleciona o botão que irá minimizar o menu
    const btnMinimizarMenu = document.querySelector('#menu-toggle');

    // adiciona um evento de clique ao botão
    btnMinimizarMenu.addEventListener('click', () => {
      // seleciona o elemento do menu lateral
      const div = document.querySelector('.div');

      // alterna a classe CSS que esconde o menu lateral
      div.classList.contains('esconder-menu');
      if (div.classList.toggle('esconder-menu')) {
        btnMinimizarMenu.innerHTML = "<strong>Exibir</strong>";
      } else {
        btnMinimizarMenu.innerHTML = "<strong>Fechar</strong>";
      }
    });
  </script>

  <script>
    /* Get the documentElement (<html>) to display the page in fullscreen */
    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari and Opera */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
      }
    }

    /* Close fullscreen */
    function closeFullscreen() {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        /* Firefox */
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        /* Chrome, Safari and Opera */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE/Edge */
        document.msExitFullscreen();
      }
    }
  </script>