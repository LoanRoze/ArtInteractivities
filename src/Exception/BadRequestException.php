<?php
require_once __DIR__ . '/ApiException.php';

class BadRequestException extends ApiException {
    public function __construct($message = "Requête invalide") {
        parent::__construct($message, 400);
    }
}
