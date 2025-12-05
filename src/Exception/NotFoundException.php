<?php
require_once __DIR__ . '/ApiException.php';

class NotFoundException extends ApiException {
    public function __construct($message = "Ressource non trouvée") {
        parent::__construct($message, 404);
    }
}