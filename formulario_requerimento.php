<?php
// Incluir a biblioteca TCPDF
require_once('classes/TCPDF/tcpdf.php');
include_once('classes/pessoa.class.php');



$cod_pessoa = $_GET["cod_pessoa"];

$pessoa = new Pessoa();

$record = $pessoa->exibirPessoaUsuario($cod_pessoa);

$row_pessoa = $record->fetch();

$requerente = $row_pessoa['vch_nome'];
$vch_nome_social = $row_pessoa['vch_nome_social'];
$sexo_requerente = $row_pessoa['int_sexo'];
$cpf_requerente = $row_pessoa['vch_cpf'];
$endereco_requerente = $row_pessoa['endereco'];
$cep_requerente = $row_pessoa['cep'];
$bairro_requerente = $row_pessoa['bairro'];
$telefone_requerente = $row_pessoa['vch_telefone'];
$cod_responsavel = $row_pessoa['cod_responsavel_legal'];
$vch_responsavel = $row_pessoa['vch_nome_responsavel'];
$cpf_responsavel = $row_pessoa['vch_cpf_responsavel'];
$sexo_responsavel = $row_pessoa['int_sexo_responsavel'];
$endereco_responsavel = $row_pessoa['vch_endereco_responsavel'];
$int_num_responsavel = $row_pessoa['int_num_responsavel'];
$vch_comp_responsavel = $row_pessoa['vch_comp_responsavel'];
$telefone_responsavel = $row_pessoa['vch_telefone_responsavel'];
$bairro_responsavel = $row_pessoa['vch_bairro_responsavel'];
$cep_responsavel = $row_pessoa['vch_cep_responsavel'];

$x = "X";

// die(var_dump($vch_responsavel));

// Inicie o buffer de saída para evitar qualquer saída antes da geração do PDF
ob_start();

// Verifique se a extensão GD está habilitada
if (!function_exists('imagecreatefromjpeg')) {
    die('A extensão GD não está habilitada.');
}

// Caminho para a imagem original
$imagemOriginal = 'images/FRANS.jpg';

// Verifique se o arquivo de imagem existe antes de tentar carregá-lo
if (!file_exists($imagemOriginal)) {
    die('O arquivo de imagem não foi encontrado.');
}

// Carregue a imagem
$imagem = imagecreatefromjpeg($imagemOriginal);

if ($imagem === false) {
    die('Falha ao carregar a imagem JPEG.');
}


$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


// Adicionar uma página ao PDF
$pdf->AddPage();

// Carregar a imagem original
$imagemOriginal = 'images/FRANS.jpg';
$pdf->Image($imagemOriginal);

// Configurações de cor e fonte
$corTexto = imagecolorallocate($imagem, 0, 0, 0); // Cor do texto (branco)
$fonte = 'images/arial/arial.ttf'; // Caminho para a sua fonte TrueType

// Adicionar texto à imagem
imagettftext($imagem, 26, 0, 110, 780, $corTexto, $fonte, $requerente);
if($sexo_requerente == 1){
    imagettftext($imagem, 26, 0, 1109, 752, $corTexto, $fonte, $x);
}else if($sexo_requerente == 2){
    imagettftext($imagem, 26, 0, 1180, 752, $corTexto, $fonte, $x);    
}
imagettftext($imagem, 25, 0, 1250, 780, $corTexto, $fonte, $cpf_requerente);
imagettftext($imagem, 26, 0, 110, 888, $corTexto, $fonte, $vch_nome_social);
if($sexo_responsavel == 1){
    imagettftext($imagem, 26, 0, 1111, 962, $corTexto, $fonte, $x);
}else if($sexo_requerente == 2){
    imagettftext($imagem, 26, 0, 1186, 962, $corTexto, $fonte, $x);    
}

imagettftext($imagem, 25, 0, 140, 1571, $corTexto, $fonte, $x);
imagettftext($imagem, 25, 0, 268, 1571, $corTexto, $fonte, $x);
imagettftext($imagem, 25, 0, 1343, 1571, $corTexto, $fonte, $x);
imagettftext($imagem, 25, 0, 1005, 1658, $corTexto, $fonte, $x);

if($cod_responsavel != null || $cod_responsavel != ""){
    imagettftext($imagem, 25, 0, 110, 988, $corTexto, $fonte, $vch_responsavel);
    imagettftext($imagem, 25, 0, 1250, 988, $corTexto, $fonte, $cpf_responsavel);
    imagettftext($imagem, 25, 0, 110, 1099, $corTexto, $fonte, $endereco_responsavel);
    imagettftext($imagem, 25, 0, 110, 1200, $corTexto, $fonte, $int_num_responsavel);
    imagettftext($imagem, 25, 0, 375, 1200, $corTexto, $fonte, $vch_comp_responsavel);
    imagettftext($imagem, 25, 0, 1250, 1200, $corTexto, $fonte, $telefone_responsavel);
    imagettftext($imagem, 25, 0, 110, 1300, $corTexto, $fonte, $bairro_responsavel);
    imagettftext($imagem, 25, 0, 1250, 1300, $corTexto, $fonte, $cep_responsavel);
}else if($cod_responsavel == null || $cod_responsavel == ""){
    imagettftext($imagem, 25, 0, 110, 1099, $corTexto, $fonte, $endereco_requerente);
    imagettftext($imagem, 25, 0, 110, 1200, $corTexto, $fonte, $int_num_responsavel);
    imagettftext($imagem, 25, 0, 375, 1200, $corTexto, $fonte, $vch_comp_responsavel);
    imagettftext($imagem, 25, 0, 1250, 1200, $corTexto, $fonte, $telefone_requerente);
    imagettftext($imagem, 25, 0, 110, 1300, $corTexto, $fonte, $bairro_requerente);
    imagettftext($imagem, 25, 0, 1250, 1300, $corTexto, $fonte, $cep_requerente);
}

// Nome da imagem gerada
$imagemGerada = 'uploads/imagem.jpg';

// Salvar a imagem com o texto
imagejpeg($imagem, $imagemGerada);

// Adicionar a imagem ao PDF
$pdf->Image($imagemGerada, 5, 5, 440, 600, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

// Nome do arquivo PDF de saída
// $arquivoPDF = 'images/arquivo.pdf';

// Saída do PDF para o navegador (ou você pode salvar em um arquivo)
$pdf->Output();

// Liberar memória
imagedestroy($imagem);

// echo 'PDF gerado com sucesso!';

?>
