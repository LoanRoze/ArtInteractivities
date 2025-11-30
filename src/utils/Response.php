<?php

class Response
{
    private int $status = 200;
    private array|string|null $payload = null;

    public function status(int $code): self
    {
        $this->status = $code;
        return $this;
    }

    public function json($data): void
    {
        $this->payload = $data;
        http_response_code($this->status);
        header("Content-Type: application/json");
        echo json_encode($this->payload);
    }

    public function send(string $data): void
    {
        $this->payload = $data;
        http_response_code($this->status);
        echo $this->payload;
    }
}