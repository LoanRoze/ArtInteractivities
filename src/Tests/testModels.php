<?php

// ==================== MODELS ====================
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Artist.php';
require_once __DIR__ . '/../Models/Company.php';
require_once __DIR__ . '/../Models/Address.php';

// ==================== TESTS ====================

echo "<h2>Test CRUD Users</h2>";
$user = new User();

$userId = $user->create(
    'test@test.com',
    password_hash('123456', PASSWORD_DEFAULT),
    0,
    0,
    1
);

echo $userId ? "<p>Utilisateur créé : </p>" : "<p>Erreur création utilisateur</p>";
print_r($user->getById($userId));

$updated = $user->updateEmail($userId, 'modif@test.com');
echo $updated ? "<p>Email mis à jour</p>" : "<p>Erreur mise à jour email</p>";

$deleted = $user->delete($userId);
echo $deleted ? "<p>Utilisateur supprimé</p>" : "<p>Problème lors de la suppression de l’utilisateur</p>";


echo "<h2>Test CRUD Artists</h2>";
$artist = new Artist();

$artistId = $artist->create(
    'Jean',
    'Dupont',
    'Monsieur',
    '1980-01-01',
    '0123456789',
    'https://site.com'
);
echo $artistId ? "<p>Artiste créé : $artistId</p>" : "<p>Erreur création artiste</p>";
print_r($artist->getById($artistId));

$updatedArtist = $artist->updateNom($artistId, 'Durand');
echo $updatedArtist ? "<p>Nom artiste mis à jour</p>" : "<p>Erreur mise à jour nom artiste</p>";

$deletedArtist = $artist->delete($artistId);
echo $deletedArtist ? "<p>Artiste supprimé</p>" : "<p>Problème suppression artiste</p>";


echo "<h2>Test CRUD Companies</h2>";
$company = new Company();

$companyId = $company->create(
    'MaSociete',
    '12345678901234',
    'Pierre',
    'Martin',
    'Infos complémentaires'
);
echo $companyId ? "<p>Entreprise créée : $companyId</p>" : "<p>Erreur création entreprise</p>";
print_r($company->getById($companyId));

$updatedCompany = $company->updateRaisonSociale($companyId, 'NouvelleSociete');
echo $updatedCompany ? "<p>Raison sociale mise à jour</p>" : "<p>Erreur mise à jour raison sociale</p>";

$deletedCompany = $company->delete($companyId);
echo $deletedCompany ? "<p>Entreprise supprimée</p>" : "<p>Problème suppression entreprise</p>";


echo "<h2>Test CRUD Addresses</h2>";
$address = new Address();

$companyTempId = $company->create(
    'TempSociete',
    '98765432109876',
    'Paul',
    'Durand',
    'Infos'
);

$addressId = $address->create(
    $companyTempId,
    'entreprise',
    '123 Rue Exemple',
    'Bat A',
    'Nouvelle-Aquitaine',
    '33000',
    'Bordeaux',
    'France'
);
echo $addressId ? "<p>Adresse créée : $addressId</p>" : "<p>Erreur création adresse</p>";
print_r($address->getById($addressId));

$updatedAddress = $address->updateAdresse($addressId, '456 Rue Test');
echo $updatedAddress ? "<p>Adresse mise à jour</p>" : "<p>Erreur mise à jour adresse</p>";

$deletedAddress = $address->delete($addressId);
echo $deletedAddress ? "<p>Adresse supprimée</p>" : "<p>Problème suppression adresse</p>";
