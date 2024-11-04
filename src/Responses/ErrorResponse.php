<?php

namespace App\Responses;

use App\Responses\ResponseInterface;

class ErrorResponse implements ResponseInterface
{
    private string $status;
    private string $message;
    private string $data;
    private string $code;

    public function __construct(string $message, int $code)
    {
        $this->status = 'false';
        $this->message = $message;
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
            'message' => $this->getMessage()
        ], JSON_PRETTY_PRINT);
    }
}
