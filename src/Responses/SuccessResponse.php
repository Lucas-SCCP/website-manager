<?php

namespace App\Responses;

use App\Responses\ResponseInterface;

class SuccessResponse implements ResponseInterface
{
    private string $status;
    private string $message;
    private string $data;
    private string $code;

    public function __construct(mixed $data, string $message, int $code)
    {
        $this->status = 'success';
        $this->message = $message;
        $this->data = json_encode($data);
        $this->code = $code;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function jsonFormat(): string
    {
        http_response_code($this->code);
        return json_encode([
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'data' => json_decode($this->getData())
        ], JSON_PRETTY_PRINT);
    }
}
