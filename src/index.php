<?php

// Utils
require_once __DIR__ . '/../src/utils/Request.php';
require_once __DIR__ . '/../src/utils/Response.php';

// Routes
require_once __DIR__ . '/../src/routes/users.php';
require_once __DIR__ . '/../src/routes/artists.php';
require_once __DIR__ . '/../src/routes/companies.php';
require_once __DIR__ . '/../src/routes/addresses.php';

$req = new Request();
$res = new Response();

$method = $req->method;
$uri = $req->url;

$uri = preg_replace('#^/api#', '', $uri);


// =========================================================
// ========================= USERS =========================
// =========================================================

if ($uri === '/users' && $method === 'POST') {
    return createUser($req, $res);
}

if (preg_match('#^/users/(\d+)$#', $uri, $m)) {
    $req->params = ['id' => $m[1]];

    if ($method === 'GET') return getUser($req, $res);
    if ($method === 'PUT') return updateUserEmail($req, $res);
    if ($method === 'DELETE') return deleteUser($req, $res);
}

if ($uri === '/users' && $method === 'GET') {
    return getAllUsers($req, $res);
}



// =========================================================
// ======================== ARTISTS ========================
// =========================================================

if ($uri === '/artists' && $method === 'POST') {
    return createArtist($req, $res);
}

if ($uri === '/artists' && $method === 'GET') {
    return getArtistByFullName($req, $res);
}

if (preg_match('#^/artists/(\d+)$#', $uri, $m)) {
    $req->params = ['id' => $m[1]];
    
    if ($method === 'GET') return getArtist($req, $res);
    if ($method === 'PUT') return updateArtistName($req, $res);
    if ($method === 'DELETE') return deleteArtist($req, $res);
}



// =========================================================
// ======================= COMPANIES =======================
// =========================================================

if ($uri === '/companies' && $method === 'POST') {
    return createCompany($req, $res);
}

if ($uri === '/companies' && $method === 'GET') {
    // recherche par SIRET dans query: /companies?siret=1234
    return getCompanyBySiret($req, $res);
}

if ($uri === '/companies/all' && $method === 'GET') {
    return getAllCompanies($req, $res);
}

if (preg_match('#^/companies/(\d+)$#', $uri, $m)) {
    $req->params = ['id' => $m[1]];

    if ($method === 'GET') return getCompany($req, $res);
    if ($method === 'PUT') return updateCompanyName($req, $res);
    if ($method === 'DELETE') return deleteCompany($req, $res);
}



// =========================================================
// ======================= ADDRESSES =======================
// =========================================================

if ($uri === '/addresses' && $method === 'POST') {
    return createAddress($req, $res);
}

if ($uri === '/addresses' && $method === 'GET') {
    return getAddressesByType($req, $res);
}

if (preg_match('#^/addresses/(\d+)$#', $uri, $m)) {
    $req->params = ['id' => $m[1]];

    if ($method === 'GET') return getAddress($req, $res);
    if ($method === 'PUT') return updateAddress($req, $res);
    if ($method === 'DELETE') return deleteAddress($req, $res);
}

if (preg_match('#^/addresses/company/(\d+)$#', $uri, $m) && $method === 'GET') {
    $req->params = ['id' => $m[1]];
    return getAddressesByCompany($req, $res);
}


$res->status(404)->json(["error" => "Route not found"]);
