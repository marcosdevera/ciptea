<?php
// Incluir a biblioteca TCPDF
require_once('classes/TCPDF/tcpdf.php');

$requerente = $_POST['vch_nome'];
$vch_nome_social = $_POST['vch_nome_social'];
$sexo_requerente = $_POST['int_sexo'];
$cpf_requerente = $_POST['vch_cpf'];
$endereco_requerente = $_POST['endereco'];
$cep_requerente = $_POST['cep'];
$bairro_requerente = $_POST['bairro'];
$telefone_requerente = $_POST['vch_telefone'];
$cod_responsavel = $_POST['cod_responsavel_legal'];
$vch_responsavel = $_POST['vch_nome_responsavel'];
$cpf_responsavel = $_POST['vch_cpf_responsavel'];
$sexo_responsavel = $_POST['int_sexo_responsavel'];
$endereco_responsavel = $_POST['vch_endereco_responsavel'];
$int_num_responsavel = $_POST['int_num_responsavel'];
$vch_comp_responsavel = $_POST['vch_comp_responsavel'];
$telefone_responsavel = $_POST['vch_telefone_responsavel'];
$bairro_responsavel = $_POST['vch_bairro_responsavel'];
$cep_responsavel = $_POST['vch_cep_responsavel'];
$x = "X";

// die(var_dump($vch_responsavel));

// Criar uma nova instância TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Adicionar uma página ao PDF
$pdf->AddPage();

// Carregar a imagem original
$imagemOriginal = 'images/FRANS.jpg';
$imagem = imagecreatefromjpeg($imagemOriginal);

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
