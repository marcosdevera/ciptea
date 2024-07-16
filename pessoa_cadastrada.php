<?php 
include_once('classes/pessoa.class.php');

// Cria o Objeto
$p = new Pessoa();
$localizar = isset($_GET['localizar']) ? $_GET['localizar'] : '';
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

if ($localizar || $cpf) {
    $result = $p->pesquisarPessoa($localizar, $cpf);
} else {
    $result = $p->exibirPessoa();
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Confirmação de Pessoa</title>

  <!-- Custom styles for this template -->
  <link href="css/menu-lateral.css" rel="stylesheet">

  <!-- Bootstrap e dependências -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/formValidation.css">
  <link rel="stylesheet" href="css/loading.css">
  <link rel="stylesheet" href="css/bootstrap-combobox.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('images/background_login2.webp') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
    }
    .container {
      margin-top: 30px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .navbar {
      background-color: #343a40;
      color: white;
    }
    .navbar .navbar-brand, .navbar-nav .nav-link {
      color: white;
    }
    .navbar .nav-link:hover {
      color: #007bff;
    }
    .table thead {
      background-color: #007bff;
      color: white;
    }
    .table .btn {
      margin: 0 2px;
    }
    .btn-primary, .btn-success, .btn-danger {
      border-radius: 20px;
    }
    .form-group label {
      font-weight: bold;
    }
    .input-group {
      margin-bottom: 15px;
    }
    .input-group-addon {
      display: flex;
      align-items: center;
      padding: 10px;
      background-color: #e9ecef;
      border: 1px solid #ced4da;
      border-radius: 4px;
    }
    .alert {
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-home"></i> Início</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-cog"></i> Configurações</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="processamento/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h3>Localizar</h3>

    <form role="form" name="form2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" data-toggle="validator">
      <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-search"></i></span>
        <input id="localizar" type="text" class="form-control" name="localizar" style="text-transform:uppercase;" placeholder="Nome">
        <input id="cpf" type="text" class="form-control" name="cpf" placeholder="CPF">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </span>
      </div>
    </form>

    <?php 
      if(isset($_GET['msg'])) {
        $msg = $_GET['msg']; 
        if($msg == 1) { ?>
          <div class="alert alert-success">
            <strong>Sucesso!</strong> Operação concluída.
          </div> 
    <?php } 
        if($msg == 2) { ?>
          <div class="alert alert-danger">
            <strong>Erro!</strong> Operação não pode ser concluída.
          </div>
    <?php } 
      } ?>
    
    <table class="table table-striped table-bordered" style="margin-top:10px;">
      <thead>
        <tr>
          <th>Nome</th>
          <th>RG</th>
          <th>CPF</th>
          <th>Cartão do SUS</th>
          <th>Nome do Pai</th>
          <th>Nome da Mãe</th>
          <th>Data de Nascimento</th>
          <th>CEP</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        while($row_pessoa = $result->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr>
            <td><?php echo $row_pessoa["vch_nome"]; ?></td>
            <td><?php echo $row_pessoa["vch_rg"]; ?></td>
            <td><?php echo $row_pessoa["vch_cpf"]; ?></td>
            <td><?php echo $row_pessoa["vch_num_cartao_sus"]; ?></td>
            <td><?php echo $row_pessoa["vch_nome_pai"]; ?></td>
            <td><?php echo $row_pessoa["vch_nome_mae"]; ?></td>
            <td><?php echo date("d/m/Y", strtotime($row_pessoa["sdt_nascimento"])); ?></td>
            <td><?php echo $row_pessoa["cep"]; ?></td>
            <td align="center">
              <?php 
                $cod_pessoa_encode = base64_encode($row_pessoa["cod_pessoa"]);
                $cod_usuario_encode = base64_encode($row_pessoa["cod_usuario"]);
              ?>
              <a href="avaliacao_documento.php?cod=<?php echo urlencode($cod_pessoa_encode) ?>">
                <?php if($row_pessoa["status_foto"] == 1 && $row_pessoa["status_laudo"] == 1 && $row_pessoa["status_comprovante"] == 1 && $row_pessoa["status_documento"] == 1 && $row_pessoa["status_requerimento"] == 1){ ?>
                  <button class="btn btn-success">Avaliar documentos</button>
                <?php } else { ?>
                  <button class="btn btn-primary">Avaliar documentos</button>
                <?php } ?>
              </a>
              <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-cod_pessoa="<?php echo $row_pessoa['cod_pessoa']; ?>">Apagar</button>
            </td>
          </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Modal para confirmação de exclusão -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirmar Exclusão</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Você tem certeza que deseja apagar esta pessoa?
        </div>
        <div class="modal-footer">
          <form action="processamento/apagar_cadastro.php" method="post">
            <input type="hidden" name="cod_pessoa" id="deleteCodPessoa">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Apagar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Extras -->
  <?php include("scripts.php"); ?>
  <script>
    $('#confirmModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var codPessoa = button.data('cod_pessoa');
      var modal = $(this);
      modal.find('#deleteCodPessoa').val(codPessoa);
    });
  </script>
</body>
</html>
