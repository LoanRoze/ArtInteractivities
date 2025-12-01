<?php

require_once __DIR__ . '/../Controllers/UserController.php';

function createUser($req, $res) {
    $controller = new UserController();
    return $controller->register($req, $res);
}

function updateUserEmail($req, $res) {
    $controller = new UserController();
    return $controller->updateEmail($req, $res);
}

function getUser($req, $res) {
    $controller = new UserController();
    return $controller->getById($req, $res);
}

function getAllUsers($req, $res) {
    $controller = new UserController();
    return $controller->getAll($req, $res);
}

function deleteUser($req, $res) {
    $controller = new UserController();
    return $controller->delete($req, $res);
}