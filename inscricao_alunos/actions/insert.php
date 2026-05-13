<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';

    // Remove espaços em branco
    $nome = trim($nome);
    $email = trim($email);

    if (!empty($nome) && !empty($email)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } catch(PDOException $e) {
            die("Erro ao inserir registro: " . $e->getMessage());
        }
    }
}

// Redireciona de volta para a página principal
header("Location: ../index.php");
exit();
?>
