<?php

include_once("../classes/conexao.class.php");

try {
    $cpf = $_POST['cpf'];

    $pdo = Database::conexao();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM ciptea.dados_pessoa WHERE vch_cpf = :cpf");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();

    $result = $stmt->fetchColumn();

    if ($result > 0) {
        echo json_encode(['status' => 'error', 'message' => 'CPF já cadastrado.']);
    } else {
        echo json_encode(['status' => 'success']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}
?>
