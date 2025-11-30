<?php
require_once __DIR__ . '\..\Models\User.php';
require_once __DIR__ . '\..\Exception\BadRequestException.php';
require_once __DIR__ . '\..\Exception\ConflictException.php';
require_once __DIR__ . '\..\Exception\NotFoundException.php';

class UserService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function registerUser($data): array
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $stay_connected = $data['stay_connected'] ?? null;
        $newsletter = $data['newsletter'] ?? null;
        $accept_cgu = $data['accept_cgu'] ?? null;

        if (!$email || !$password || $stay_connected === null || $newsletter === null || $accept_cgu === null) {
            throw new BadRequestException("Tous les champs sont requis");
        }

        foreach ($this->userModel->getAll() as $user) {
            if ($user['email'] === $email) {
                throw new ConflictException("Email déjà utilisé");
            }
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $id = $this->userModel->create($email, $passwordHash, $stay_connected, $newsletter, $accept_cgu);
        return $this->getUserById($id);
    }

    public function getUserById($id): array
    {
        $user = $this->userModel->getById($id);
        if (!$user)
            throw new NotFoundException("Utilisateur non trouvé");
        return [
            'id' => $user['id'],
            'email' => $user['email']
        ];
    }

    public function getUserByEmail($email): array
    {
        foreach ($this->userModel->getAll() as $user) {
            if ($user['email'] === $email) {
                return [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];
            }
        }
        throw new NotFoundException("Utilisateur non trouvé");
    }

    public function updateUserEmail($id, $newEmail): array
    {
        if (!$newEmail)
            throw new BadRequestException("Email requis");

        $user = $this->userModel->getById($id);
        if (!$user)
            throw new NotFoundException("Utilisateur non trouvé");

        foreach ($this->userModel->getAll() as $user) {
            if ($user['email'] === $newEmail && $user['id'] != $id) {
                throw new ConflictException("Email déjà utilisé");
            }
        }

        $this->userModel->updateEmail($id, $newEmail);
        return $this->getUserById($id);
    }

    public function deleteUser($id): bool
    {
        $user = $this->userModel->getById($id);
        if (!$user)
            throw new NotFoundException("Utilisateur non trouvé");
        return $this->userModel->delete($id);
    }

    public function getAllUsers(): array
    {
        $users = $this->userModel->getAll();
        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'id' => $user['id'],
                'email' => $user['email']
            ];
        }
        return $formatted;
    }
}
