<?php
require_once __DIR__ . '/ApiException.php';

class ConflictException extends ApiException {
    public function __construct($message = "Conflit") {
        parent::__construct($message, 409);
    }
}