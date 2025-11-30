<?php
// models/User.php
require_once __DIR__ . '/../dbConnect/Database.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create($email, $password_hash, $stay_connected, $newsletter, $accept_cgu)
    {
        $sql = "INSERT INTO users (email, password_hash, stay_connected, newsletter, accept_cgu)
            VALUES (:email, :password_hash, :stay_connected, :newsletter, :accept_cgu)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password_hash', $password_hash);
        $stmt->bindValue(':stay_connected', $stay_connected ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':newsletter', $newsletter ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':accept_cgu', $accept_cgu ? 1 : 0, PDO::PARAM_INT);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM users")->fetchAll();
    }

    public function updateEmail($id, $email)
    {
        return $this->pdo->prepare("UPDATE users SET email=? WHERE id=?")->execute([$email, $id]);
    }

    public function delete($id)
    {
        return $this->pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
    }
}