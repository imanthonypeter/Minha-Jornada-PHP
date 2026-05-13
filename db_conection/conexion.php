<?php

$host = "localhost";
$db = "school";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("postgresql:host = $host; db name = $db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    PDO::ERRMODE_EXCEPTION;
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}
?>