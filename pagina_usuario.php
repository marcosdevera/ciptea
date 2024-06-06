<?php 
    include_once('classes/pessoa.class.php');
    include_once('classes/obs.class.php');
    include_once('classes/documentos.class.php');
    include_once("sessao.php");
  
    //Cria o Objeto
    $p = new Pessoa();
    // die(var_dump($_SESSION["cod_pessoa"]));
    $cod_pessoa = $_SESSION['cod_pessoa'];
    $cod_usuario = $_SESSION["user_session"];
    $result_pessoa = $p->exibirPessoaUsuario($cod_usuario);
    $row_pessoa = $result_pessoa->fetch(PDO::FETCH_ASSOC);

    $d = new Documentos();
    $result_requerimento = $d->buscarRequerimento($cod_pessoa);
    $row_requerimento = $result_requerimento->rowCount();
    // die(var_dump($row_requerimento));
    $obs = new Obs();
    $result_obs = $obs->exibirobs($row_pessoa['cod_pessoa']);
    $num_linha = $result_obs->rowCount(); 
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Página do usuário</title>

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
    .container{
      margin-left: 1em;
    }
  </style>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <?php include("menu.php"); ?>

    <div class="container">
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
              <th>Foto de identificação</th>
              <th>Imagem do Laudo</th>
              <th>Comprovante de Residência</th>
              <th>Documento com foto</th>
              <?php if($row_requerimento != 0 ){ ?>
                <th>Requerimento enviado</th>
                <th>Baixe o requerimento novamente</th>
              <?php } else{ ?>
                <th>Baixe aqui seu reqeurimento requerimento</th>  
              <?php } ?> 
              <th>Status</th>
              <th>Alterar dados</th>
            </tr>
          </thead>

          <tbody>
            <tr>
            <td><?php echo $row_pessoa["vch_nome"]; ?></td> 
            <td><?php echo $row_pessoa["vch_rg"]; ?></td> 
            <td><?php echo $row_pessoa["vch_cpf"]; ?></td> 
            <td style="vertical-align: middle;   text-align: center;"><?php echo "<a target='_blank' href='ciptea/".$row_pessoa["foto"]."'><img src='images/document.png' style='height: 50px' alt='Abrir Documento'></a>"?></td>
            <td style="vertical-align: middle;   text-align: center;"><?php echo "<a target='_blank' href='ciptea/".$row_pessoa["laudo"]."'><img src='images/document.png' style='height: 50px;' alt='Abrir Documento'></a>"?></td>
            <td style="vertical-align: middle;   text-align: center;"><?php echo "<a target='_blank' href='ciptea/".$row_pessoa["comp_residencia"]."'><img src='images/document.png' style='height: 50px;' alt='Abrir Documento'></a>"?></td>
            <td style="vertical-align: middle;   text-align: center;"><?php echo "<a target='_blank' href='ciptea/".$row_pessoa["documento"]."'><img src='images/document.png' style='height: 50px;' alt='Abrir Documento'></a>"?></td> 
            <?php if($row_requerimento != 0 ){ ?>
              <td style="vertical-align: middle;   text-align: center;"><?php echo "<a target='_blank' href='ciptea/".$row_pessoa["requerimento"]."'><img src='images/document.png' style='height: 50px;' alt='Abrir Documento'></a>"?></td>
            <?php } ?>
            <td>
              <form action="formulario_requerimento.php" method="POST">
                <input type="hidden" name="vch_nome" id="vch_nome" value="<?php echo $row_pessoa["vch_nome"] ?>">
                <input type="hidden" name="vch_rg" id="vch_rg" value="<?php echo $row_pessoa["vch_rg"] ?>">
                <input type="hidden" name="vch_cpf" id="vch_cpf" value="<?php echo $row_pessoa["vch_cpf"] ?>">
                <input type="hidden" name="endereco" id="endereco" value="<?php echo $row_pessoa["endereco"] ?>">
                <input type="hidden" name="cep" id="cep" value="<?php echo $row_pessoa["cep"] ?>">
                <input type="hidden" name="bairro" id="bairro" value="<?php echo $row_pessoa["bairro"] ?>">
                <input type="hidden" name="vch_telefone" id="vch_telefone" value="<?php echo $row_pessoa["vch_telefone"] ?>">
                <input type="hidden" name="cod_responsavel_legal" id="cod_responsavel_legal" value="<?php echo $row_pessoa["cod_responsavel_legal"] ?>">
                <input type="hidden" name="vch_nome_responsavel" id="vch_nome_responsavel" value="<?php echo $row_pessoa["vch_nome_responsavel"] ?>">
                <input type="hidden" name="vch_cpf_responsavel" id="vch_cpf_responsavel" value="<?php echo $row_pessoa["vch_cpf_responsavel"] ?>">
                <input type="hidden" name="vch_endereco_responsavel" id="vch_endereco_responsavel" value="<?php echo $row_pessoa["vch_endereco_responsavel"] ?>">
                <input type="hidden" name="vch_bairro_responsavel" id="vch_bairro_responsavel" value="<?php echo $row_pessoa["vch_bairro_responsavel"] ?>">
                <input type="hidden" name="vch_telefone_responsavel" id="vch_telefone_responsavel" value="<?php echo $row_pessoa["vch_telefone_responsavel"] ?>">
                <input type="hidden" name="vch_cep_responsavel" id="vch_cep_responsavel" value="<?php echo $row_pessoa["vch_cep_responsavel"] ?>">
                <input type="hidden" name="int_sexo" id="int_sexo" value="<?php echo $row_pessoa["int_sexo"] ?>">
                <input type="hidden" name="vch_nome_social" id="vch_nome_social" value="<?php echo $row_pessoa["vch_nome_social"] ?>">
                <input type="hidden" name="int_sexo_responsavel" id="int_sexo_responsavel" value="<?php echo $row_pessoa["int_sexo_responsavel"] ?>">
                <input type="hidden" name="int_num_responsavel" id="int_num_responsavel" value="<?php echo $row_pessoa["int_num_responsavel"] ?>">
                <input type="hidden" name="vch_comp_responsavel" id="vch_comp_responsavel" value="<?php echo $row_pessoa["vch_comp_responsavel"] ?>"> 
                <input type="submit" class="btn btn-warning" value="Clique aqui para baixar requerimento">             
              </form>
              <?php if($row_requerimento == 0 ){ ?>
              <form action="processamento/processar_usuario.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="form_requerimento" id="form_requerimento" style="margin-top: 8px;">
                <input type="hidden" name="cod_pessoa" id="cod_pessoa" value="<?php echo $row_pessoa["cod_pessoa"] ?>">
                <input type="hidden" name="MM_action" id="MM_action" value="5">
                <input type="submit" class="btn btn-primary" value="Enviar" style="margin-top: 4px;">
              </form>
              <?php } ?>
            </td>  
            <td><strong><?php if($row_pessoa["status_foto"] == 1 && $row_pessoa["status_laudo"] == 1 && $row_pessoa["status_comprovante"] == 1 && $row_pessoa["status_documento"] == 1 && $row_pessoa["status_requerimento"] == 1){echo "Aprovado";}else{echo "Aguardando validação";}?></strong></td>
            <td>
              <a href="reenviar_cadastro.php">
              <button class="btn btn-primary">Alterar dados cadastrados</button>
              </a>
            </td>                            
            <?php 
            if($row_pessoa["status_foto"] == 1 && $row_pessoa["status_laudo"] == 1 && $row_pessoa["status_comprovante"] == 1 && $row_pessoa["status_documento"] == 1 && $row_pessoa["status_requerimento"] == 1){ ?>
              <td align="center">
                <a href="carteirinha.php">
                <button class="btn btn-primary">Gerar Carteirinha</button>
                </a>
              </td>
            <?php } ?> 
                <!-- <td><a data-toggle="modal" data-target="#myModal" href="forms/alterar_transportadora.php?cod_transportadora=<?php /* echo $row_transportadora['cod_transportadora']; ?>"> <span class="glyphicon glyphicon-pencil"></span> </a><a data-toggle="modal" data-target="#myModal" href="forms/excluir_transportadora.php?cod_transportadora=<?php echo $row_transportadora["cod_transportadora"]; */?>"> <span class="glyphicon glyphicon-trash"></span> </a></td> -->
            </tr>
          </tbody>
        </table>
        <?php
        // while($row_obs = $result_obs->fetch(PDO::FETCH_ASSOC)) {
        //     // Adicionar cada registro à string, separados por uma quebra de linha
        //     $registros .= "ID: " . $row_obs["cod_obs"] . " - Coluna1: " . $row_obs["obs"] . " - Coluna2: " . $row_obs["sdt_criacao"] . "\n";
        //     // Você pode adicionar mais colunas conforme necessário
        // }
        // if (empty($results)) {
        //     $registros = "Nenhum registro encontrado.";
        // }
        ?>
        <label for="obs">Observações :</label>
        <textarea name="obs" id="obs" cols="152" rows="4"><?php if($num_linha > 0){ 
            $count = "";
            while($row_obs = $result_obs->fetch(PDO::FETCH_ASSOC)) {
                $count++;
                echo date("d/m/Y", strtotime($row_obs["sdt_criacao"])). " - - " . $row_obs["obs"] . "\n";
            }    
        } ?></textarea>
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