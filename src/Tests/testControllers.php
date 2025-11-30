<?php


require_once __DIR__ . '\..\utils\Request.php';
require_once __DIR__ . '\..\utils\Response.php';


require_once __DIR__ . '\..\Controllers\UserController.php';
require_once __DIR__ . '\..\Controllers\ArtistController.php';
require_once __DIR__ . '\..\Controllers\CompanyController.php';
require_once __DIR__ . '\..\Controllers\AddressController.php';


echo "<h1>Tests Controllers</h1>";


// ==================== UserController ====================

echo "<h2>UserController</h2>";

$userController = new UserController();
$res = new Response();

// CREATE
$req = new Request();
$req->body = [
    'email' => 'ctrl@test.com',
    'password' => '123456',
    'stay_connected' => false,
    'newsletter' => false,
    'accept_cgu' => true
];

$userController->register($req, $res);


// ==================== ArtistController ====================

echo "<h2>ArtistController</h2>";

$artistController = new ArtistController();

// CREATE
$req = new Request();
$req->body = [
    'prenom' => 'Jean',
    'nom' => 'Dupont',
    'civilite' => 'Monsieur',
    'date_naissance' => '1980-01-01',
    'telephone' => '0123456789',
    'site_web' => 'https://site.com'
];

$artistController->create($req, $res);


// ==================== CompanyController ====================

echo "<h2>CompanyController</h2>";

$companyController = new CompanyController();

$req = new Request();
$req->body = [
    'raison_sociale' => 'CtrlSociete',
    'siret' => '12345678901234',
    'prenom_contact' => 'Pierre',
    'nom_contact' => 'Martin',
    'infos_complementaires' => 'Test'
];

$companyController->create($req, $res);


// ==================== AddressController ====================

echo "<h2>AddressController</h2>";

$addressController = new AddressController();

$req = new Request();
$req->body = [
    'company_id' => 1,
    'type' => 'entreprise',
    'adresse' => '12 Rue Test',
    'complement' => 'Bât A',
    'region' => 'NA',
    'code_postal' => '33000',
    'ville' => 'Bordeaux',
    'pays' => 'France'
];

$addressController->create($req, $res);
