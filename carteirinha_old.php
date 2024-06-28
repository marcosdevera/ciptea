<?php
include_once('../classes/pessoa.class.php');
include_once('../sessao.php');

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_GET['cod_pessoa'];
$p = new Pessoa();
$result_pessoa = $p->exibirPessoaUsuario($cod_pessoa);
$row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);

$nome = $row_p['vch_nome'];
$nomePai = $row_p['vch_nome_pai'];
$nomeMae = $row_p['vch_nome_mae'];
$dataNascimento = date("d/m/Y", strtotime($row_p['sdt_nascimento']));
$endereco = $row_p['endereco'];
$bairro = $row_p['bairro'];                
$telefone = $row_p['vch_telefone_contato'];
$tipoSanguineo = $row_p['vch_tipo_sanguineo'];
$cid = $row_p['cid'];
$cpf = $row_p['vch_cpf'];
$rg = $row_p['vch_rg'];
$cartao_sus = $row_p['vch_num_cartao_sus'];
$num_carteira = $row_p['cod_pessoa'];

// Aqui você pode adicionar a lógica para gerar a carteirinha, por exemplo, criar um PDF ou exibir os dados formatados

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteirinha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Carteirinha</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $nome; ?></h5>
                <p class="card-text">CPF: <?php echo $cpf; ?></p>
                <p class="card-text">RG: <?php echo $rg; ?></p>
                <p class="card-text">Data de Nascimento: <?php echo $dataNascimento; ?></p>
                <p class="card-text">Endereço: <?php echo $endereco . ', ' . $bairro; ?></p>
                <p class="card-text">Telefone: <?php echo $telefone; ?></p>
                <p class="card-text">Tipo Sanguíneo: <?php echo $tipoSanguineo; ?></p>
                <p class="card-text">CID: <?php echo $cid; ?></p>
                <p class="card-text">Cartão SUS: <?php echo $cartao_sus; ?></p>
                <p class="card-text">Número da Carteira: <?php echo $num_carteira; ?></p>
                <!-- Aqui você pode adicionar mais campos ou personalizações para a carteirinha -->
            </div>
        </div>
    </div>
</body>
</html>
