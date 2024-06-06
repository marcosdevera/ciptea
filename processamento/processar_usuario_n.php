<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../classes/usuario.class.php');
include_once('../classes/pessoa.class.php');
include_once('../classes/obs.class.php');
include_once('../classes/documentos.class.php');

$pessoa = new Pessoa();

if (isset($_POST['vch_nome'])) {
    $pessoa->setVchNome($_POST['vch_nome']);
}

if (isset($_POST['vch_telefone'])) {
    $telefone_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone']);
    $pessoa->setVchTelefone($telefone_format);
}

if (isset($_POST['vch_telefone_contato'])) {
    $telefone_contato_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone_contato']);
    $pessoa->setVchTelefoneContato($telefone_contato_format);
}

if (isset($_POST['sexo'])) {
    $pessoa->setIntSexo($_POST['sexo']);
}

if (isset($_POST['cid'])) {
    $pessoa->setCid($_POST['cid']);
}

if (isset($_POST['vch_tipo_sanguineo'])) {
    $pessoa->setVchTipoSanguineo($_POST['vch_tipo_sanguineo']);
}

if (isset($_POST['vch_nome_social'])) {
    $pessoa->setVchNomeSocial($_POST['vch_nome_social']);
}

if (isset($_POST['vch_nome_pai'])) {
    $pessoa->setVchNomePai($_POST['vch_nome_pai']);
}

if (isset($_POST['vch_nome_mae'])) {
    $pessoa->setVchNomeMae($_POST['vch_nome_mae']);
}

if (isset($_POST['sdt_nascimento'])) {
    $pessoa->setSdtNascimento($_POST['sdt_nascimento']);
}

if (isset($_POST['endereco'])) {
    $pessoa->setEndereco($_POST['endereco']);
}

if (isset($_POST['bairro'])) {
    $pessoa->setBairro($_POST['bairro']);
}

if (isset($_POST['cep'])) {
    $cep_format = str_replace('-', '', $_POST['cep']);
    $pessoa->setCep($cep_format);
}

if (isset($_POST['cidade'])) {
    $pessoa->setCidade($_POST['cidade']);
}

if (isset($_POST['vch_rg'])) {
    $rg_format = str_replace(['.', '-'], '', $_POST['vch_rg']);
    $pessoa->setVchRg($rg_format);
}

if (isset($_POST['vch_num_cartao_sus'])) {
    $cartao_sus_format = str_replace(['.', '-'], '', $_POST['vch_num_cartao_sus']);
    $pessoa->setVchNumCartaoSus($cartao_sus_format);
}

if (isset($_POST['vch_cpf'])) {
    // Remover pontos e traços do CPF
    $cpf_sem_pontos = str_replace(array(".", "-"), "", $_POST['vch_cpf']);

    // Setar o CPF sem pontos e traços
    $pessoa->setVchCpf($cpf_sem_pontos);
}



if (isset($_POST['bool_representante_legal'])) {
    $pessoa->setBoolRepresentanteLegal($_POST['bool_representante_legal']);
}

if (isset($_POST['vch_nome_reponsavel'])) {
    $pessoa->setVchNomeResponsavel($_POST['vch_nome_reponsavel']);
}

if (isset($_POST['sexo_responsavel'])) {
    $pessoa->setIntSexoResponsavel($_POST['sexo_responsavel']);
}

if (isset($_POST['vch_telefone_responsavel'])) {
    $telefone_responsavel_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone_responsavel']);
    $pessoa->setVchTelefoneResponsavel($telefone_responsavel_format);
}

if (isset($_POST['vch_cpf_responsavel'])) {
    $cpf_responsavel_format = str_replace(['.', '-'], '', $_POST['vch_cpf_responsavel']);
    $pessoa->setVchCpfResponsavel($cpf_responsavel_format);
}

if (isset($_POST['vch_cep_responsavel'])) {
    $cep_responsavel_format = str_replace('-', '', $_POST['vch_cep_responsavel']);
    $pessoa->setVchCepResponsavel($cep_responsavel_format);
}

if (isset($_POST['vch_endereco_responsavel'])) {
    $pessoa->setVchEnderecoResponsavel($_POST['vch_endereco_responsavel']);
}

if (isset($_POST['num_responsavel'])) {
    $pessoa->setNumResponsavel($_POST['num_responsavel']);
}

if (isset($_POST['vch_bairro_responsavel'])) {
    $pessoa->setVchBairroResponsavel($_POST['vch_bairro_responsavel']);
}

if (isset($_POST['vch_cidade_responsavel'])) {
    $pessoa->setVchCidadeResponsavel($_POST['vch_cidade_responsavel']);
}

if (isset($_POST['vch_login'])) {
    $pessoa->setVchLogin($_POST['vch_login']);
}

if (isset($_POST['vch_senha'])) {
    $pessoa->setVchSenha(password_hash($_POST['vch_senha'], PASSWORD_DEFAULT));
}

try {
    $pessoa->save();
    echo "Cadastro realizado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao realizar o cadastro: " . $e->getMessage();
}
?>
