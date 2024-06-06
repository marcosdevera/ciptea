<?php
include_once("../classes/conexao.class.php");
try {
    $login = $_POST['login'];
    
    $pdo = Database::conexao();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM ciptea.usuario WHERE vch_login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    
    $result = $stmt->fetchColumn();
    
    if ($result > 0) {
        echo '1'; // CPF vinculado a este login encontrado
    } else {
        echo '0'; // CPF vinculado a este login não encontrado
    }
} catch(PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}
?>
