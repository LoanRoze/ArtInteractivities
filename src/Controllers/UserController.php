<?php

require_once __DIR__ . '/../Services/UserService.php';

class UserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function register(Request $req, Response $res)
    {
        try {
            $data = $req->body;
            $result = $this->service->registerUser($data);
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getAll(Request $req, Response $res)
    {
        try {
            return $res->json($this->service->getAllUsers());
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getById(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            return $res->json($this->service->getUserById($id));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function updateEmail(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            return $res->json(
                $this->service->updateUserEmail($id, $req->body['email'] ?? null)
            );
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function delete(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $this->service->deleteUser($id);
            return $res->json(['message' => 'Utilisateur supprimé']);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }
}
