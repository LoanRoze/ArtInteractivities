<?php
// models/Artist.php
require_once __DIR__ . '/../dbConnect/Database.php';

class Artist
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create($prenom, $nom, $civilite, $date_naissance, $telephone, $site_web)
    {
        $sql = "INSERT INTO artists (prenom, nom, civilite, date_naissance, telephone, site_web)
            VALUES (:prenom, :nom, :civilite, :date_naissance, :telephone, :site_web)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':civilite' => $civilite,
            ':date_naissance' => $date_naissance,
            ':telephone' => $telephone,
            ':site_web' => $site_web
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM artists WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }


    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM artists")->fetchAll();
    }

    public function updateNom($id, $nom)
    {
        return $this->pdo->prepare("UPDATE artists SET nom=? WHERE id=?")->execute([$nom, $id]);
    }

    public function delete($id)
    {
        return $this->pdo->prepare("DELETE FROM artists WHERE id=?")->execute([$id]);
    }
}