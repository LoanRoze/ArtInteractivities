<?php

require_once __DIR__ . '/../Controllers/ArtistController.php';

function createArtist($req, $res) {
    $controller = new ArtistController();
    return $controller->create($req, $res);
}

function getArtist($req, $res) {
    $controller = new ArtistController();
    return $controller->getById($req, $res);
}

function getArtistByFullName($req, $res) {
    $controller = new ArtistController();
    return $controller->getByFullName($req, $res);
}

function updateArtistName($req, $res) {
    $controller = new ArtistController();
    return $controller->updateName($req, $res);
}

function deleteArtist($req, $res) {
    $controller = new ArtistController();
    return $controller->delete($req, $res);
}