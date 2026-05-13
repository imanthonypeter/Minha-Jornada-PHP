<?php

$sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["Novo nome", "novoemail@gmail.com", 1]);

echo ("User atualizado!");

?>