<?php
require 'vendor/autoload.php'; // Inclui o autoload do Composer
require_once('vendor/tecnickcom/tcpdf/tcpdf.php'); // Inclui a biblioteca TCPDF
include_once('classes/pessoa.class.php');
include_once('sessao.php');
include_once('classes/documentos.class.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['cod_pessoa']) && !isset($_GET['cod_pessoa'])) {
    echo 'cod_pessoa não fornecido.';
    exit;
}

function formatarTelefone($numero) {
    $numero = preg_replace('/\D/', '', $numero);
    $tamanho = strlen($numero);
    if ($tamanho === 10) {
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $numero);
    } elseif ($tamanho === 11) {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numero);
    } else {
        return $numero;
    }
}

$cod_pessoa = isset($_POST['cod_pessoa']) ? $_POST['cod_pessoa'] : $_GET['cod_pessoa'];

$p = new Pessoa();
$d = new Documentos();

$result_pessoa = $p->exibirPessoaUsuario($cod_pessoa);
$row_p = $result_pessoa->fetch(PDO::FETCH_ASSOC) ?: [];

$result_foto = $d->buscarDocumentoPessoa($cod_pessoa, 1);
$foto_path = $result_foto && $result_foto->rowCount() > 0 ? 'uploads/' . $result_foto->fetch(PDO::FETCH_ASSOC)['vch_documento'] : 'uploads/default_photo.png';

// Redimensionar e cortar a imagem para 3x4 cm (300x400 px)
$largura = 300;
$altura = 400;
$salvar_em = 'uploads/adjusted_photo.jpg';

function redimensionarECortarImagem($caminho, $largura_alvo, $altura_alvo, $salvar_em) {
    $imagem = @imagecreatefromstring(file_get_contents($caminho));
    if (!$imagem) {
        echo 'Falha ao criar a imagem.';
        return;
    }

    $largura_original = imagesx($imagem);
    $altura_original = imagesy($imagem);

    // Calcula a proporção para ajustar a imagem sem distorcê-la
    $proporcao_original = $largura_original / $altura_original;
    $proporcao_alvo = $largura_alvo / $altura_alvo;

    if ($proporcao_original > $proporcao_alvo) {
        // A imagem é mais larga do que precisamos, cortar a largura
        $nova_altura = $altura_alvo;
        $nova_largura = intval($altura_alvo * $proporcao_original);
    } else {
        // A imagem é mais alta do que precisamos, cortar a altura
        $nova_largura = $largura_alvo;
        $nova_altura = intval($largura_alvo / $proporcao_original);
    }

    // Criar nova imagem redimensionada
    $imagem_redimensionada = imagecreatetruecolor($largura_alvo, $altura_alvo);

    // Copia com ajuste de tamanho
    imagecopyresampled($imagem_redimensionada, $imagem, 
        0 - intval(($nova_largura - $largura_alvo) / 2), // centro a imagem no eixo X
        0 - intval(($nova_altura - $altura_alvo) / 2),   // centro a imagem no eixo Y
        0, 0, 
        $nova_largura, $nova_altura, 
        $largura_original, $altura_original
    );

    // Salvar a imagem redimensionada
    imagejpeg($imagem_redimensionada, $salvar_em);
    imagedestroy($imagem);
    imagedestroy($imagem_redimensionada);
}

redimensionarECortarImagem($foto_path, $largura, $altura, $salvar_em);

class MYPDF extends TCPDF {
    public function Header() {
        $this->Image('images/1_front.jpg', 0, 0, 72, 114);
    }

    public function AddBackground() {
        $this->AddPage();
        $this->Image('images/2_back.jpg', 0, 0, 72, 114);
    }
}

$pdf = new MYPDF('P', 'mm', [72, 114], true, 'UTF-8', false);
$pdf->SetMargins(0, 0, 0);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage();

// Adicionar a imagem da pessoa redimensionada
$pdf->Image($salvar_em, 24.5, 25.3, 22.7, 31);

// Definir a fonte e a cor do texto
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(5, 60);
$pdf->MultiCell(62, 6, strtoupper($row_p['vch_nome']), 0, 'C');

// Calcular a nova posição para as informações adicionais se o nome for longo
$yPos = $pdf->GetY() + 2;
$maxY = 90; // Limite inferior da área azul

if ($yPos < $maxY) {
    $pdf->SetFont('helvetica', '', 8);
    $pdf->SetXY(5, $yPos);
    $pdf->MultiCell(62, 4, 
        "Nome Pai: " . $row_p['vch_nome_pai'] . "\n" .
        "Nome Mãe: " . $row_p['vch_nome_mae'] . "\n" .
        "Data Nascimento: " . date("d/m/Y", strtotime($row_p['sdt_nascimento'])) . "\n" .
        "Endereço: " . $row_p['endereco'] . " " . $row_p['bairro'] . "\n" .
        "Telefone: " . formatarTelefone($row_p['vch_telefone'])  . "\n" .
        "Tipo Sanguíneo: " . $row_p['vch_tipo_sanguineo'], 0, 'L');
} else {
    // Adicionar o verso do crachá e colocar as informações lá
    $pdf->AddBackground();
    $pdf->SetFont('helvetica', '', 8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY(5, 20);
    $pdf->MultiCell(62, 4, 
        "Nome Pai: " . $row_p['vch_nome_pai'] . "\n" .
        "Nome Mãe: " . $row_p['vch_nome_mae'] . "\n" .
        "Data Nascimento: " . date("d/m/Y", strtotime($row_p['sdt_nascimento'])) . "\n" .
        "Endereço: " . $row_p['endereco'] . " " . $row_p['bairro'] . "\n" .
        "Telefone: " . formatarTelefone($row_p['vch_telefone'])  . "\n" .
        "Tipo Sanguíneo: " . $row_p['vch_tipo_sanguineo'], 0, 'L');
}

// Posicionar o texto na parte inferior da primeira página
$pdf->SetTextColor(255, 255, 0);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetXY(0, 104);
$pdf->Cell(72, 10, 'ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020', 0, 1, 'C');

// Adicionar o verso do crachá
if ($yPos < $maxY) {
    $pdf->AddBackground();
}
$pdf->SetFont('helvetica', '', 8);
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
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetXY(0, 104);
$pdf->Cell(72, 10, 'ATENDIMENTO PRIORITÁRIO LEI Nº 13.977/2020', 0, 1, 'C');

ob_end_clean();
$pdf->Output('identificacao.pdf', 'I');

?>
