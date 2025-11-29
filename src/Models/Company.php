<?php
// models/Company.php
require_once __DIR__ . '/../dbConnect/Database.php';

class Company
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create($raison_sociale, $siret, $prenom_contact, $nom_contact, $infos_complementaires)
    {
        $sql = "INSERT INTO companies (raison_sociale, siret, prenom_contact, nom_contact, infos_complementaires)
            VALUES (:raison_sociale, :siret, :prenom_contact, :nom_contact, :infos_complementaires)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ':raison_sociale' => $raison_sociale,
            ':siret' => $siret,
            ':prenom_contact' => $prenom_contact,
            ':nom_contact' => $nom_contact,
            ':infos_complementaires' => $infos_complementaires
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM companies")->fetchAll();
    }

    public function updateRaisonSociale($id, $raison)
    {
        return $this->pdo->prepare("UPDATE companies SET raison_sociale=? WHERE id=?")->execute([$raison, $id]);
    }

    public function delete($id)
    {
        return $this->pdo->prepare("DELETE FROM companies WHERE id=?")->execute([$id]);
    }
}