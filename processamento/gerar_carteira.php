<?php
include_once('../classes/pessoa.class.php');
include_once('../classes/documentos.class.php');
include_once('../sessao.php');

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_POST['cod_pessoa'];
$p = new Pessoa();
$d = new Documentos();
$result_pessoa = $p->exibirPessoaUsuario($cod_pessoa);
$row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC);

// Buscar a foto 3x4
$result_foto = $d->buscarDocumentoPessoa($cod_pessoa, 1); // 1 é o código do tipo de documento para a foto 3x4
$foto_path = '';
if ($result_foto && $result_foto->rowCount() > 0) {
    $row_foto = $result_foto->fetch(PDO::FETCH_ASSOC);
    $foto_path = '../uploads/' . $row_foto['vch_documento'];
}

// Verificação de documentos (simplificada)
$documentos_obrigatorios = [1, 2, 3, 4, 5]; // IDs dos tipos de documentos obrigatórios
$documentos_enviados = [];

foreach ($documentos_obrigatorios as $cod_tipo_documento) {
    $resultado = $d->buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento);
    if ($resultado && $resultado->rowCount() > 0) {
        $documentos_enviados[] = $cod_tipo_documento;
    }
}

if (count($documentos_enviados) == count($documentos_obrigatorios)) {
    $vch_documento = $row_p['vch_documento'] = 1;
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
        'success' => true,
        'message' => 'Carteira gerada com sucesso',
        'data' => [
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
            'num_carteira' => $num_carteira,
            'foto_path' => $foto_path
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Por favor, envie todos os documentos obrigatórios antes de gerar a carteira'
    ]);
}
?>
