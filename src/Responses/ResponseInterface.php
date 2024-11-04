<?php

namespace App\Responses;

interface ResponseInterface {
    public function getMessage(): string;
    public function getCode(): int;
    public function jsonFormat(): string;
}
