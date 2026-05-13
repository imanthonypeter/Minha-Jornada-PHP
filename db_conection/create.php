<?php

$sql = "INSERT INTO  usuarios(nome, email) VALUES(??)";
$stmt = $pdo->prepare($sql);

$stmt->execute(["Anthony", "anthonypeteroficial@gmail.com"]);

echo "Usuário criado!";

?>