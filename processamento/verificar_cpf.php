<?php
include_once("../classes/conexao.class.php");

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

try {
    $cpf = $_POST['cpf'];

    if (!validarCPF($cpf)) {
        echo json_encode(['status' => 'error', 'message' => 'CPF inválido.']);
        exit();
    }

    $pdo = Database::conexao();
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM ciptea.dados_pessoa WHERE vch_cpf = :cpf");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        echo json_encode(['status' => 'error', 'message' => 'CPF já cadastrado.']);
    } else {
        echo json_encode(['status' => 'success']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}
?>
