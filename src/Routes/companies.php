<?php

require_once __DIR__ . '/../Controllers/CompanyController.php';

function createCompany($req, $res) {
    $controller = new CompanyController();
    return $controller->create($req, $res);
}

function getCompany($req, $res) {
    $controller = new CompanyController();
    return $controller->getById($req, $res);
}

function getCompanyBySiret($req, $res) {
    $controller = new CompanyController();
    return $controller->getBySiret($req, $res);
}

function getAllCompanies($req, $res) {
    $controller = new CompanyController();
    return $controller->getAll($req, $res);
}

function updateCompanyName($req, $res) {
    $controller = new CompanyController();
    return $controller->updateRaisonSociale($req, $res);
}

function deleteCompany($req, $res) {
    $controller = new CompanyController();
    return $controller->delete($req, $res);
}
