<?php
require_once __DIR__ . '\..\Models\Artist.php';
require_once __DIR__ . '\..\Exception\BadRequestException.php';
require_once __DIR__ . '\..\Exception\NotFoundException.php';

class ArtistService
{
    private $artistModel;

    public function __construct()
    {
        $this->artistModel = new Artist();
    }

    public function addArtist($data): array
    {
        $prenom = $data['prenom'] ?? null;
        $nom = $data['nom'] ?? null;
        $civilite = $data['civilite'] ?? null;
        $date_naissance = $data['date_naissance'] ?? null;
        $telephone = $data['telephone'] ?? null;
        $site_web = $data['site_web'] ?? null;

        if (!$prenom || !$nom || !$civilite || !$date_naissance || !$telephone || !$site_web) {
            throw new BadRequestException("Tous les champs sont requis");
        }
        $id = $this->artistModel->create($prenom, $nom, $civilite, $date_naissance, $telephone, $site_web);
        return $this->getArtistById($id);
    }

    public function getArtistById($id): array
    {
        $artist = $this->artistModel->getById($id);
        if (!$artist)
            throw new NotFoundException("Artiste non trouvé");
        return [
            'id' => $artist['id'],
            'prenom' => $artist['prenom'],
            'nom' => $artist['nom'],
            'civilite' => $artist['civilite']
        ];
    }

    public function getArtistByFullName($prenom, $nom): array
    {
        foreach ($this->artistModel->getAll() as $artist) {
            if ($artist['prenom'] === $prenom && $artist['nom'] === $nom) {
                return [
                    'id' => $artist['id'],
                    'prenom' => $artist['prenom'],
                    'nom' => $artist['nom']
                ];
            }
        }
        throw new NotFoundException("Artiste non trouvé");
    }

    public function updateArtistName($id, $newNom): array  
    {
        if (!$newNom)
            throw new BadRequestException("Nom requis");
        $artist = $this->artistModel->getById($id);
        if (!$artist)
            throw new NotFoundException("Artiste non trouvé");
        $this->artistModel->updateNom($id, $newNom);
        return $this->getArtistById($id);
    }

    public function deleteArtist($id): bool
    {
        $artist = $this->artistModel->getById($id);
        if (!$artist)
            throw new NotFoundException("Artiste non trouvé");
        return $this->artistModel->delete($id);
    }

    public function getAllArtists(): array
    {
        $artists = $this->artistModel->getAll();
        $formatted = [];
        foreach ($artists as $artist) {
            $formatted[] = [
                'id' => $artist['id'],
                'prenom' => $artist['prenom'],
                'nom' => $artist['nom']
            ];
        }
        return $formatted;
    }
}