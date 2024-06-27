<?php
include_once('../classes/pessoa.class.php');
include_once('../sessao.php');

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_SESSION['cod_pessoa'];
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

echo json_encode([
    'nome' => $nome,
    'nomePai' => $nomePai,
    'nomeMae' => $nomeMae,
    'dataNascimento' => $dataNascimento,
    'endereco' => $endereco,
    'bairro' => $bairro,
    'telefone' => $telefone,
    'tipoSanguineo' => $tipoSanguineo,
    'cid' => $cid,
    'cpf' => $cpf,
    'rg' => $rg,
    'cartao_sus' => $cartao_sus,
    'num_carteira' => $num_carteira
]);
?>
