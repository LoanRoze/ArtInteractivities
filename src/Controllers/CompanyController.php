<?php

require_once __DIR__ . '/../Services/CompanyService.php';

class CompanyController
{
    private CompanyService $service;

    public function __construct()
    {
        $this->service = new CompanyService();
    }

    public function create(Request $req, Response $res)
    {
        try {
            $data = $req->body;
            $result = $this->service->addCompany($data);
            return $res->json($result);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getById(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            return $res->json($this->service->getCompanyById($id));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getBySiret(Request $req, Response $res)
    {
        try {
            $siret = $req->query['siret'] ?? null;
            return $res->json($this->service->getCompanyBySiret($siret));
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function updateRaisonSociale(Request $req, Response $res)
    {
        try {
            $id = $req->params['id'];
            $result = $this->service->updateCompanyRaisonSociale(
                $id,
                $req->body['raison_sociale'] ?? null
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
            $this->service->deleteCompany($id);
            return $res->json(['message' => 'Société supprimée']);
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }

    public function getAll(Request $req, Response $res)
    {
        try {
            return $res->json($this->service->getAllCompanies());
        } catch (Exception $err) {
            return $res->status(400)->json(['error' => $err->getMessage()]);
        }
    }
}
