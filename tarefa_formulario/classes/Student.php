<?php
class Student
{
    private $conn;
    private $table = "alunos";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Inserir aluno (retorna true/false)
    public function insert($nome, $email)
    {
        if (!$this->conn) return false;
        $query = "INSERT INTO " . $this->table . " (nome, email) VALUES (:nome, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }

    // Excluir pelo ID
    public function delete($id)
    {
        if (!$this->conn) return false;
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Listar todos os alunos
    public function readAll()
    {
        if (!$this->conn) return [];
        $query = "SELECT id, nome, email, criado_em FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}