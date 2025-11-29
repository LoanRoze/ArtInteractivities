<?php
// models/Address.php
require_once __DIR__ . '/../dbConnect/Database.php';

class Address
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create($company_id, $type, $adresse, $complement, $region, $code_postal, $ville, $pays)
    {
        $sql = "INSERT INTO addresses (company_id, type, adresse, complement, region, code_postal, ville, pays)
            VALUES (:company_id, :type, :adresse, :complement, :region, :code_postal, :ville, :pays)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ':company_id' => $company_id,
            ':type' => $type,
            ':adresse' => $adresse,
            ':complement' => $complement,
            ':region' => $region,
            ':code_postal' => $code_postal,
            ':ville' => $ville,
            ':pays' => $pays
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM addresses WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM addresses")->fetchAll();
    }

    public function getByCompanyId($company_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM addresses WHERE company_id = :company_id");
        $stmt->execute([':company_id' => $company_id]);
        return $stmt->fetchAll();
    }

    public function updateAdresse($id, $adresse)
    {
        return $this->pdo->prepare("UPDATE addresses SET adresse=? WHERE id=?")->execute([$adresse, $id]);
    }

    public function delete($id)
    {
        return $this->pdo->prepare("DELETE FROM addresses WHERE id=?")->execute([$id]);
    }
}