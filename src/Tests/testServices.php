<?php

require_once __DIR__ . '\..\Services\UserService.php';
require_once __DIR__ . '\..\Services\ArtistService.php';
require_once __DIR__ . '\..\Services\CompanyService.php';
require_once __DIR__ . '\..\Services\AddressService.php';

echo "<h1>Tests Services</h1>";

// ==================== UserService ====================

echo "<h2>UserService</h2>";

$userService = new UserService();

// CREATE
$userDatas = $userService->registerUser([
    'email' => 'service@test.com',
    'password' => 'password123',
    'stay_connected' => false,
    'newsletter' => false,
    'accept_cgu' => true
]);
$userId = $userDatas['id'];

echo "<p>User created: $userId</p>";
print_r($userService->getUserById($userId));

// UPDATE
$updated = $userService->updateUserEmail($userId, 'service_modif@test.com');
echo $updated ? "<p>Email updated</p>" : "<p>Email update failed</p>";

// DELETE
$deleted = $userService->deleteUser($userId);
echo $deleted ? "<p>User deleted</p>" : "<p>User delete failed</p>";


// ==================== ArtistService ====================

echo "<h2>ArtistService</h2>";

$artistService = new ArtistService();

$artistDatas = $artistService->addArtist([
    'prenom' => 'Jean',
    'nom' => 'Dupont',
    'civilite' => 'Monsieur',
    'date_naissance' => '1980-01-01',
    'telephone' => '0123456789',
    'site_web' => 'https://site.com'
]);
$artistId = $artistDatas['id'];

echo "<p>Artist created: $artistId</p>";
print_r($artistService->getArtistById($artistId));

$artistService->updateArtistName($artistId, 'Durand');
echo "<p>Name updated</p>";

$artistService->deleteArtist($artistId);
echo "<p>Artist deleted</p>";


// ==================== CompanyService ====================

echo "<h2>CompanyService</h2>";

$companyService = new CompanyService();

$companyDatas = $companyService->addCompany([
    'raison_sociale' => 'MaSociete',
    'siret' => '12345678901234',
    'prenom_contact' => 'Pierre',
    'nom_contact' => 'Martin',
    'infos_complementaires' => 'Infos'
]);
$companyId = $companyDatas['id'];

echo "<p>Company created: $companyId</p>";
print_r($companyService->getCompanyById($companyId));

$companyService->updateCompanyRaisonSociale($companyId, 'MaSocieteModifiee');
echo "<p>Company updated</p>";




// ==================== AddressService ====================

echo "<h2>AddressService</h2>";

$addressService = new AddressService();

$addressDatas = $addressService->addAddress([
    'company_id' => $companyId,
    'type' => 'entreprise',
    'adresse' => '123 Rue Exemple',
    'complement' => 'Bat A',
    'region' => 'Nouvelle-Aquitaine',
    'code_postal' => '33000',
    'ville' => 'Bordeaux',
    'pays' => 'France'
]);
$addressId = $addressDatas['id'];

echo "<p>Address created: $addressId</p>";
print_r($addressService->getAddressById($addressId));

$addressService->updateAddress($addressId, '456 Rue Test');
echo "<p>Address updated</p>";

$addressService->deleteAddress($addressId);
echo "<p>Address deleted</p>";

$companyService->deleteCompany($companyId);
echo "<p>Company deleted</p>";