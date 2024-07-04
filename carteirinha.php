<?php
include_once('classes/pessoa.class.php');
include_once('sessao.php');
include_once('classes/documentos.class.php');

if (!isset($_SESSION)) {
    session_start();
}

$p = new Pessoa();
$d = new Documentos();

$cod_pessoa = $_SESSION['cod_pessoa'];

$result_pessoa = $p->exibirPessoaUsuario($cod_pessoa);

if ($result_pessoa->rowCount() === 0) {
    die("Usuário não encontrado.");
}

$row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);

// Buscar a foto 3x4
$result_foto = $d->buscarDocumentoPessoa($cod_pessoa, 1); // 1 é o código do tipo de documento para a foto 3x4
$foto_path = 'uploads/default_photo.png'; // Caminho para uma foto padrão caso a foto do usuário não exista

if ($result_foto && $result_foto->rowCount() > 0) {
    $row_foto = $result_foto->fetch(PDO::FETCH_ASSOC);
    $foto_path = 'uploads/' . $row_foto['vch_documento'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteira de Identificação</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="id-card">
        <div class="background"></div>
        <div class="header-background"></div>
        <div class="photo">
            <img src="<?php echo $foto_path; ?>" alt="Foto da Pessoa">
        </div>
        <div class="info">
            <?php
                if ($row_p) {
                    $nome = $row_p['vch_nome'];
                    $nomePai = $row_p['vch_nome_pai'];
                    $nomeMae = $row_p['vch_nome_mae'];
                    $dataNascimento = date("d/m/Y", strtotime($row_p['sdt_nascimento']));
                    $endereco = $row_p['endereco'];
                    $bairro = $row_p['bairro'];                
                    $telefone = $row_p['vch_telefone'];
                    $tipoSanguineo = $row_p['vch_tipo_sanguineo'];
                    $cid = $row_p['cid'];

                    echo "<p class='nome'>$nome</p>";
                    echo "<p class='detalhes'><strong>Nome Pai:</strong> $nomePai</p>";
                    echo "<p class='detalhes'><strong>Nome Mãe:</strong> $nomeMae</p>";
                    echo "<p class='detalhes'><strong>Data Nascimento:</strong> $dataNascimento</p>";
                    echo "<p class='detalhes'><strong>Endereço:</strong> " . $endereco . " " . $bairro . "</p>";
                    echo "<p class='detalhes'><strong>Telefone:</strong> $telefone</p>";
                    echo "<p class='detalhes'><strong>Tipo Sanguíneo:</strong> $tipoSanguineo</p>";
                } else {
                    echo "<p class='detalhes'>Dados do usuário não encontrados.</p>";
                }
            ?>
        </div>
        <div class="footer">
            ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020
        </div>
    </div>

    <div class="id-card">
        <div class="background"></div>
        <div class="header-background-back"></div>

        <div class="info back-info">
            <?php
                if ($row_p) {
                    $cpf = $row_p['vch_cpf'];
                    $rg = $row_p['vch_rg'];
                    $cartao_sus = $row_p['vch_num_cartao_sus'];
                    $num_carteira = $row_p['cod_pessoa'];

                    echo "<p class='detalhes'><strong>CID:</strong> $cid</p>";            
                    echo "<p class='detalhes'><strong>CPF:</strong> $cpf</p>";
                    echo "<p class='detalhes'><strong>RG:</strong> $rg</p>";
                    echo "<p class='detalhes'><strong>Cartão SUS:</strong> $cartao_sus</p>";
                    echo "<p class='detalhes'><strong>Num. Carteira:</strong> $num_carteira</p>";
                } else {
                    echo "<p class='detalhes'>Dados do usuário não encontrados.</p>";
                }
            ?>
        </div>
        <div class="footer">
            ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020
        </div>
    </div>
</body>
</html>
