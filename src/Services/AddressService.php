<?php
require_once __DIR__ . '\..\Models\Address.php';
require_once __DIR__ . '\..\Exception\BadRequestException.php';
require_once __DIR__ . '\..\Exception\NotFoundException.php';

class AddressService
{
    private $addressModel;

    public function __construct()
    {
        $this->addressModel = new Address();
    }

    public function addAddress($data): array
    {
        $company_id = $data['company_id'] ?? null;
        $type = $data['type'] ?? null;
        $adresse = $data['adresse'] ?? null;
        $complement = $data['complement'] ?? null;
        $region = $data['region'] ?? null;
        $code_postal = $data['code_postal'] ?? null;
        $ville = $data['ville'] ?? null;
        $pays = $data['pays'] ?? null;

        if (!$company_id || !$type || !$adresse || !$region || !$code_postal || !$ville || !$pays) {
            throw new BadRequestException("Tous les champs obligatoires sont requis");
        }

        $id = $this->addressModel->create($company_id, $type, $adresse, $complement, $region, $code_postal, $ville, $pays);
        return $this->getAddressById($id);
    }

    public function getAddressById($id): array
    {
        $address = $this->addressModel->getById($id);
        if (!$address)
            throw new NotFoundException("Adresse non trouvée");
        return [
            'id' => $address['id'],
            'company_id' => $address['company_id'],
            'type' => $address['type'],
            'adresse' => $address['adresse'],
            'ville' => $address['ville']
        ];
    }

    public function getAddressesByCompany($company_id): array
    {
        $all = $this->addressModel->getAll();
        $filtered = [];
        foreach ($all as $address) {
            if ($address['company_id'] == $company_id)
                $filtered[] = $this->getAddressById($address['id']);
        }
        return $filtered;
    }

    public function getAddressesByType($type): array
    {
        $all = $this->addressModel->getAll();
        $filtered = [];
        foreach ($all as $address) {
            if ($address['type'] === $type)
                $filtered[] = $this->getAddressById($address['id']);
        }
        return $filtered;
    }

    public function updateAddress($id, $newAdresse): array
    {
        if (!$newAdresse)
            throw new BadRequestException("Adresse requise");
        $address = $this->addressModel->getById($id);
        if (!$address)
            throw new NotFoundException("Adresse non trouvée");
        $this->addressModel->updateAdresse($id, $newAdresse);
        return $this->getAddressById($id);
    }

    public function deleteAddress($id): bool
    {
        $address = $this->addressModel->getById($id);
        if (!$address)
            throw new NotFoundException("Adresse non trouvée");
        return $this->addressModel->delete($id);
    }
}
