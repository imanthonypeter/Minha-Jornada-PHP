<?php
require_once '../config/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        die("Erro ao excluir registro: " . $e->getMessage());
    }
}

// Redireciona de volta para a página principal
header("Location: ../index.php");
exit();
?>
