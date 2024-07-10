<?php
ob_start(); // Inicia o buffer de saída

require 'vendor/autoload.php'; // Inclui o autoload do Composer
include_once('classes/pessoa.class.php');
include_once('sessao.php');
include_once('classes/documentos.class.php');

use setasign\Fpdi\Tcpdf\Fpdi;
use Intervention\Image\ImageManagerStatic as Image;

// Verifica se a sessão está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verifica se 'cod_pessoa' está definido
if (!isset($_POST['cod_pessoa']) && !isset($_GET['cod_pessoa'])) {
    echo 'cod_pessoa não fornecido.';
    exit;
}

// Obter 'cod_pessoa' da URL ou POST
$cod_pessoa = isset($_POST['cod_pessoa']) ? $_POST['cod_pessoa'] : $_GET['cod_pessoa'];

$p = new Pessoa();
$d = new Documentos();

$result_pessoa = $p->exibirPessoaUsuario($cod_pessoa);
$row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC) ?: [];

$result_foto = $d->buscarDocumentoPessoa($cod_pessoa, 1);
$foto_path = $result_foto && $result_foto->rowCount() > 0 ? 'uploads/' . $result_foto->fetch(PDO::FETCH_ASSOC)['vch_documento'] : 'uploads/default_photo.png';

// Ajustar a imagem para o tamanho 3x4 (300x400 pixels)
$image = Image::make($foto_path);
$image->fit(300, 400, function ($constraint) {
    $constraint->upsize();
});
$adjusted_photo_path = 'uploads/adjusted_photo.png';
$image->save($adjusted_photo_path);

$front_pdf = 'images/1.pdf';
$back_pdf = 'images/2.pdf';

$pdf = new Fpdi();
$pdf->AddPage('P', [72, 114]);
$pdf->setSourceFile($front_pdf);
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 72, 114);

// Remover margens e desativar quebra automática de página
$pdf->SetMargins(0, 0, 0);
$pdf->SetAutoPageBreak(false);

// Adicionar a imagem da pessoa
$pdf->Image($adjusted_photo_path, 24.5, 25.3, 22.7, 31);

// Definir a fonte e a cor do texto
$pdf->SetFont('Helvetica', 'B', 12); // Negrito e tamanho maior para o nome
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(5, 60);
$pdf->Cell(62, 10, $row_p['vch_nome'], 0, 1, 'C');

$pdf->SetFont('Helvetica', '', 8);
$pdf->SetXY(5, 69);
$pdf->MultiCell(62, 4, 
    "Nome Pai: " . $row_p['vch_nome_pai'] . "\n" .
    "Nome Mãe: " . $row_p['vch_nome_mae'] . "\n" .
    "Data Nascimento: " . date("d/m/Y", strtotime($row_p['sdt_nascimento'])) . "\n" .
    "Endereço: " . $row_p['endereco'] . " " . $row_p['bairro'] . "\n" .
    "Telefone: " . $row_p['vch_telefone'] . "\n" .
    "Tipo Sanguíneo: " . $row_p['vch_tipo_sanguineo'], 0, 'L');

// Posicionar o texto na parte inferior da primeira página
$pdf->SetTextColor(255, 255, 0);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetXY(0, 104); // Ajuste Y para uma posição próxima ao fundo
$pdf->Cell(72, 10, 'ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020', 0, 1, 'C');

// Verso do crachá
$pdf->AddPage('P', [72, 114]);
$pdf->setSourceFile($back_pdf);
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 72, 114);

$pdf->SetFont('Helvetica', '', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(5, 60);
$pdf->MultiCell(62, 4, 
    "CID: " . $row_p['cid'] . "\n" .
    "CPF: " . $row_p['vch_cpf'] . "\n" .
    "RG: " . $row_p['vch_rg'] . "\n" .
    "Cartão SUS: " . $row_p['vch_num_cartao_sus'] . "\n" .
    "Num. Carteira: " . $cod_pessoa, 0, 'L');

// Posicionar o texto na parte inferior da segunda página
$pdf->SetTextColor(255, 255, 0);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetXY(0, 104); // Ajuste Y para uma posição próxima ao fundo
$pdf->Cell(72, 10, 'ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020', 0, 1, 'C');

ob_end_clean(); // Limpa o buffer de saída

// Saída do PDF
$pdf->Output('identificacao.pdf', 'I');
?>
