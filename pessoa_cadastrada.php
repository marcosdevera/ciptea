<?php 
  include('classes/pessoa.class.php');
  
  //Cria o Objeto
  $p = new Pessoa();
  $result = $p->exibirPessoa();
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

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <style>
    .d-flex{
      margin-top: -20px;
    }
  </style>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <?php include("menu.php"); ?>

    <div class="container">
      <h3>Localizar</h3>

      <form role="form" name="form2" action="<?php echo $_SERVER['PHP_SELF']; ?>" data-toggle="validator">
        <div class="input-group"> 
          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
          <input id="localizar" type="text" maxlength="7" class="form-control" name="localizar" style="text-transform:uppercase;" placeholder="Nome">
        </div>
      </form>

      <br>

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
            </tr>
          </thead>

          <tbody>
          <?php 
            while($row_pessoa = $result->fetch(PDO::FETCH_ASSOC))
            { ?>
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
                    <?php 
                    if($row_pessoa["status_foto"] == 1 && $row_pessoa["status_laudo"] == 1 && $row_pessoa["status_comprovante"] == 1 && $row_pessoa["status_documento"] == 1 && $row_pessoa["status_requerimento"] == 1){ ?>
                      <button class="btn btn-success">Avaliar documentos</button>
                    <?php }else{ ?>
                      <button class="btn btn-primary">Avaliar documentos</button>
                    <?php } ?>
                    </a>
                    <?php 
                    if($row_pessoa["status_foto"] == 1 && $row_pessoa["status_laudo"] == 1 && $row_pessoa["status_comprovante"] == 1 && $row_pessoa["status_documento"] == 1 && $row_pessoa["status_requerimento"] == 1){ 
                      echo "nentrou no if "; ?>
                        <a href="carteirinha.php?cod_user=<?php echo urlencode($cod_usuario_encode) ?>">
                        <button class="btn btn-primary" style="margin-top: 5px;">Gerar Carteirinha</button>
                        </a>
                    <?php }else{ ?>
                        <button class="btn btn-danger" style="margin-top: 5px;">Gerar Carteirinha</button>
                    <?php } ?>
                </td> 
                    <!-- <td><a data-toggle="modal" data-target="#myModal" href="forms/alterar_transportadora.php?cod_transportadora=<?php /* echo $row_transportadora['cod_transportadora']; ?>"> <span class="glyphicon glyphicon-pencil"></span> </a><a data-toggle="modal" data-target="#myModal" href="forms/excluir_transportadora.php?cod_transportadora=<?php echo $row_transportadora["cod_transportadora"]; */?>"> <span class="glyphicon glyphicon-trash"></span> </a></td> -->
                </tr>
                  <?php 
            } ?>
          </tbody>
        </table>
        <?php /*include("../footer.php"); */?>
    </div>
  </div>

  <!-- Modal  -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
      </div>
    </div>
  </div>
  <!-- Final Modal inserir--> 

  <!-- Scripts Extras -->
  <?php include("scripts.php"); ?>
</body>
</html>