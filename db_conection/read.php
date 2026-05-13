<?php

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $user) {
    echo $user["nome"] . " - " . $user["email"] . "<br>";
}

?>