<?php

require_once __DIR__ . '/../Services/ArtistService.php';

class ArtistController
{
    private ArtistService $service;

    public function __construct()
    {
        $this->service = new ArtistService();
    }

    public function create(Request $req, Response $res)
    {
        try {
            $data = $req->body;
            $result = $this->service->addArtist($data);
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getById(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            return $res->json($this->service->getArtistById($id));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getByFullName(Request $req, Response $res)
    {
        try {
            $prenom = $req->query['prenom'] ?? null;
            $nom = $req->query['nom'] ?? null;
            return $res->json($this->service->getArtistByFullName($prenom, $nom));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function updateName(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $result = $this->service->updateArtistName(
                $id,
                $req->body['prenom'] ?? null
            );
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function delete(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $this->service->deleteArtist($id);
            return $res->json(['message' => 'Artiste supprimé']);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }
}
