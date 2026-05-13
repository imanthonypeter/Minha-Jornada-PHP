<?php
require_once '../config/database.php';
require_once '../classes/Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    if (!empty($nome) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $database = new Database();
        $db = $database->getConnection();
        $student = new Student($db);

        if ($student->insert($nome, $email)) {
            header('Location: index.php?sucesso=1');
            exit;
        } else {
            header('Location: index.php?erro=insert');
            exit;
        }
    } else {
        header('Location: index.php?erro=validacao');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>