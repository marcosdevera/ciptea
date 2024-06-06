<?php
  include_once('classes/pessoa.class.php');
  include_once("sessao.php");

  $p = new Pessoa();

  if(isset($_GET['cod_user'])){
    $cod_usuario_decode = urldecode($_GET['cod_user']);
    $cod_usuario = base64_decode($cod_usuario_decode);
    $result_pessoa = $p->exibirPessoaUsuario($cod_usuario);
    $row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);
  }else{
    $cod_usuario = $_SESSION["user_session"];
  }
    $result_pessoa = $p->exibirPessoaUsuario($cod_usuario);
    $row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>CIPTEA - Crachá de Identificação</title>
</head>

<body>
  <div class="card">
    <div class="header">
        <img src="images/ciptea.png" alt="Header Image" class="header-image">
        <div class="camacari">
        <img src="images/brasaocamacari.png" alt="Logo" id="camacarilogo">
        </div>
      </div>
      <div class="background-photo">
        <div class="listra">
          <img src="images/background.png" class="k" alt="Listra">
        </div>
        <div class="photo">
          <!-- Aqui você pode adicionar uma foto da pessoa -->
          <img src="<?php echo "ciptea/".$row_p['foto']?>" class="profile-img" alt="Foto da Pessoa">
        </div>
      </div>
      <div class="content">
        <div class="info">
          <div class="texto" ><strong>Nome: </strong><span id="primeira_resposta"> <?php echo $row_p['vch_nome']?> </span></div>
          <strong>Nome do pai: </strong> <span class="respostas"><?php echo $row_p['vch_nome_pai']?></span>
          <strong>Nome da mãe: </strong><span class="respostas"><?php echo $row_p['vch_nome_mae']?></span>  
          <strong>Endereço: </strong> <span class="respostas"><?php echo $row_p['endereco']?></span>
          <strong>Número de contato: </strong><span class="respostas"> <?php echo $row_p['vch_telefone_contato']?> </span> 
          <strong>Data de Nascimento: </strong><span class="respostas"><?php echo date("d/m/Y", strtotime($row_p["sdt_nascimento"]));?></span>
          <strong>CID: </strong> <span class="respostas"><?php echo $row_p['cid']?></span>
          <strong>TIPO SANGUÍNEO: </strong> <span class="respostas"><?php echo $row_p['vch_tipo_sanguineo']?></span>
          
        </div>
      </div>
      <div class="bottom-info">
        <p><strong>ATENDIMENTO PRIORITÁRIO LEI N 13.977/2020</strong></p>
      </div>
  </div>
  <!-- <div>
    <button onclick="imprimirPagina()">Imprimir</button>
  </div> -->
<div class="card">
    <div class="header2">
      <img src="images/logo_sedes.png" alt="Header Image" class="header-image">
      <div class="camacari2">
      <!-- <img src="brasaocamacari.png" alt="Logo" id="camacarilogo"> -->
      </div>
    </div>
    <div class="background-photo2">
      <div class="listra2">
      <img src="images/background.png" class="k" alt="Listra">
        </div>
      <div class="photo2">
        <!-- <img src="pfp.jpg" class="profile-img" alt="Foto da Pessoa"> -->
      </div>
    </div>
    <div class="content2">
      <div class="info2">
        <p><strong>CPF: </strong> <span class="respostas"><?php echo $row_p['vch_cpf']?></span></p>
        <p><strong>RG: </strong> <span class="respostas"><?php echo $row_p['vch_rg']?></span></p>
        <p><strong>Nº Cartão do SUS: </strong><span class="respostas"><?php echo $row_p['vch_num_cartao_sus']?></span></p>
        <p><strong>Número da carteira: </strong> <span class="respostas"><?php echo $row_p['cod_pessoa']?></span></p>
        <!-- <p><strong>Nome: </strong><span class="respostas"> João da Silva </span></p>
        <p><strong>Data de Nascimento: </strong><span class="respostas">01/01/1990</span></p>
        <p><strong>Nº Cartão do SUS: </strong><span class="respostas"> 123456789</span></p>
        <p><strong>CPF: </strong> <span class="respostas">123.456.789-01</span></p>
        <p><strong>RG: </strong> <span class="respostas">987654321</span></p>
        <p><strong>NOME MÃE: </strong><span class="respostas">Maria da Silva</span></p>
        <p><strong>NOME PAI: </strong> <span class="respostas">José da Silva</span></p>
        <p><strong>ENDEREÇO: </strong> <span class="respostas">Rua Exemplo, 123 - Bairro - Cidade</span></p> -->
      </div>
    </div>
    <div class="bottom-info">
      <p><strong>ATENDIMENTO PRIORITÁRIO LEI N 13.977/2020</strong></p>
    </div>
  </div>

</body>

</html>