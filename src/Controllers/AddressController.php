<?php

require_once __DIR__ . '/../Services/AddressService.php';

class AddressController
{
    private AddressService $service;

    public function __construct()
    {
        $this->service = new AddressService();
    }

    public function create(Request $req, Response $res)
    {
        try {
            $data = $req->body;
            $result = $this->service->addAddress($data);
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getById(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            return $res->json($this->service->getAddressById($id));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getByCompany(Request $req, Response $res)
    {
        try {
            $companyId = $req->params['companyId'];
            return $res->json($this->service->getAddressesByCompany($companyId));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getByType(Request $req, Response $res)
    {
        try {
            $type = $req->query['type'] ?? null;
            return $res->json($this->service->getAddressesByType($type));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function update(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $data = $req->body;
            $result = $this->service->updateAddress($id, $data);
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function delete(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $this->service->deleteAddress($id);
            return $res->json(['message' => 'Adresse supprimée']);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }
}
