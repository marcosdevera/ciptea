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
        echo '1'; // CPF já cadastrado
    } else {
        echo '0'; // CPF não cadastrado
    }
} catch(PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}
?>
