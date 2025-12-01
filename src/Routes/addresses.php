<?php

require_once __DIR__ . '/../Controllers/AddressController.php';

function createAddress($req, $res) {
    $controller = new AddressController();
    return $controller->create($req, $res);
}

function getAddress($req, $res) {
    $controller = new AddressController();
    return $controller->getById($req, $res);
}

function getAddressesByCompany($req, $res) {
    $controller = new AddressController();
    return $controller->getByCompany($req, $res);
}

function getAddressesByType($req, $res) {
    $controller = new AddressController();
    return $controller->getByType($req, $res);
}

function updateAddress($req, $res) {
    $controller = new AddressController();
    return $controller->update($req, $res);
}

function deleteAddress($req, $res) {
    $controller = new AddressController();
    return $controller->delete($req, $res);
}