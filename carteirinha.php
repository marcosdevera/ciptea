<?php
  include_once('classes/pessoa.class.php');
  include_once("sessao.php");

  $p = new Pessoa();

  if(isset($_GET['cod_user'])){
    $cod_usuario_decode = urldecode($_GET['cod_user']);
    $cod_usuario = base64_decode($cod_usuario_decode);
    $result_pessoa = $p->exibirPessoaUsuario($cod_usuario);
    $row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);
  } else {
    $cod_usuario = $_SESSION["user_session"];
    $result_pessoa = $p->exibirPessoaUsuario($cod_usuario);
    $row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);
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

        <div class="header-background" >
            
        </div>

        <div class="photo">
            <img src="<?php echo "uploads/".$row_p['foto']; ?>" alt="Foto da Pessoa">
        </div>
        <div class="info">
            <?php
                $nome = $row_p['vch_nome'];
                $nomePai = $row_p['vch_nome_pai'];
                $nomeMae = $row_p['vch_nome_mae'];
                $dataNascimento = date("d/m/Y", strtotime($row_p['sdt_nascimento']));
                $endereco = $row_p['endereco'];
                $bairro = $row_p['bairro'];                
                $telefone = $row_p['vch_telefone_contato'];
                $tipoSanguineo = $row_p['vch_tipo_sanguineo'];
                $cid = $row_p['cid'];

                echo "<p class='nome'>$nome</p>";
                echo "<p class='detalhes'><strong>Nome Pai:</strong> $nomePai</p>";
                echo "<p class='detalhes'><strong>Nome Mãe:</strong> $nomeMae</p>";
                echo "<p class='detalhes'><strong>Data Nascimento:</strong> $dataNascimento</p>";
                echo "<p class='detalhes'><strong>End:</strong>" . $endereco . " " . $bairro . "</p>";
                echo "<p class='detalhes'><strong>Telefone:</strong> $telefone</p>";
                echo "<p class='detalhes'><strong>Tipo Sanguíneo:</strong> $tipoSanguineo</p>";

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
                    $cpf = $row_p['vch_cpf'];
                    $rg = $row_p['vch_rg'];
                    $cartao_sus = $row_p['vch_num_cartao_sus'];
                    $num_carteira = $row_p['cod_pessoa'];

                    echo "<p class='detalhes'><strong>CID:</strong> $cid</p>";            
                    echo "<p class='detalhes'><strong>CPF:</strong> $cpf</p>";
                    echo "<p class='detalhes'><strong>RG:</strong> $rg</p>";
                    echo "<p class='detalhes'><strong>Cartao SUS:</strong> $cartao_sus</p>";
                    echo "<p class='detalhes'><strong>Num. Carteira:</strong> $num_carteira</p>";
                ?>
            </div>
        
            <div class="footer">
                ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020
            </div>
            </div>
        </div>
        </div>
        </div>
    </div>



</body>
</html>
