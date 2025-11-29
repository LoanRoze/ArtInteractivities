<?php
require_once __DIR__ . '/../dbConnect/Database.php';

// Récupère l'instance de la DB
$db = Database::getInstance()->getConnection();

try {
    // Test simple : exécuter une requête
    $stmt = $db->query("SELECT NOW() as now");
    $result = $stmt->fetch();
    echo "Connexion réussie ! La base répond : " . $result['now'];
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}