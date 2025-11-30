<?php

class Request
{
    public array $query;
    public array $body;
    public array $params;
    public array $headers;
    public string $method;
    public string $url;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = strtok($_SERVER['REQUEST_URI'], '?');

        $this->query = $_GET;

        $raw = file_get_contents('php://input');
        $this->body = strlen($raw) > 0 ? json_decode($raw, true) ?? [] : [];

        $this->params = []; 

        $this->headers = getallheaders() ?: [];
    }
}