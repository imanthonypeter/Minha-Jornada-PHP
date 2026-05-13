<?php
require_once '../config/database.php';
require_once '../classes/Student.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);

    if ($student->delete($id)) {
        header('Location: index.php?sucesso=delete');
        exit;
    }
}
header('Location: index.php?erro=delete');
exit;

?>