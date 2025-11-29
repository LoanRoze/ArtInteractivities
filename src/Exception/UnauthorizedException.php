<?php
require_once __DIR__ . '/ApiException.php';

class UnauthorizedException extends ApiException {
    public function __construct($message = "Non autorisé") {
        parent::__construct($message, 401);
    }
}
