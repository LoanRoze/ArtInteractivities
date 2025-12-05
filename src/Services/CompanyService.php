<?php
require_once __DIR__ . '\..\Models\Company.php';
require_once __DIR__ . '\..\Exception\BadRequestException.php';
require_once __DIR__ . '\..\Exception\ConflictException.php';
require_once __DIR__ . '\..\Exception\NotFoundException.php';

class CompanyService {
    private $companyModel;

    public function __construct() {
        $this->companyModel = new Company();
    }

    public function addCompany($data): array {
        $raison_sociale = $data['raison_sociale'] ?? null;
        $siret = $data['siret'] ?? null;
        $prenom_contact = $data['prenom_contact'] ?? null;
        $nom_contact = $data['nom_contact'] ?? null;
        $infos_complementaires = $data['infos_complementaires'] ?? null;

        if (!$raison_sociale || !$siret || !$prenom_contact || !$nom_contact || !$infos_complementaires) {
            throw new BadRequestException("Tous les champs sont requis");
        }

        foreach($this->companyModel->getAll() as $company) {
            if($company['siret'] === $siret) {
                throw new ConflictException("SIRET déjà existant");
            }
        }

        $id = $this->companyModel->create($raison_sociale, $siret, $prenom_contact, $nom_contact, $infos_complementaires);
        return $this->getCompanyById($id);
    }

    public function getCompanyById($id): array {
        $company = $this->companyModel->getById($id);
        if (!$company) throw new NotFoundException("Entreprise non trouvée");
        return [
            'id' => $company['id'],
            'raison_sociale' => $company['raison_sociale'],
            'siret' => $company['siret']
        ];
    }

    public function getCompanyBySiret($siret): array {
        foreach($this->companyModel->getAll() as $company) {
            if($company['siret'] === $siret) return $this->getCompanyById($company['id']);
        }
        throw new NotFoundException("Entreprise non trouvée");
    }

    public function updateCompanyRaisonSociale($id, $newRaison): array {
        if (!$newRaison) throw new BadRequestException("Raison sociale requise");
        $company = $this->companyModel->getById($id);
        if (!$company) throw new NotFoundException("Entreprise non trouvée");
        $this->companyModel->updateRaisonSociale($id, $newRaison);
        return $this->getCompanyById($id);
    }

    public function deleteCompany($id): bool {
        $company = $this->companyModel->getById($id);
        if (!$company) throw new NotFoundException("Entreprise non trouvée");
        return $this->companyModel->delete($id);
    }

    public function getAllCompanies(): array {
        $companies = $this->companyModel->getAll();
        $formatted = [];
        foreach($companies as $company) {
            $formatted[] = [
                'id' => $company['id'],
                'raison_sociale' => $company['raison_sociale'],
                'siret' => $company['siret']
            ];
        }
        return $formatted;
    }
}
