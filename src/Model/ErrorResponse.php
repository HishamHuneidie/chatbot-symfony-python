<?php

namespace App\Model;

use JsonSerializable;

class ErrorResponse implements JsonSerializable
{

    public function __construct(
        private readonly string $message,
        private readonly int    $status,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function jsonSerialize(): array
    {
        return [
            "message" => $this->getMessage(),
            "status"  => $this->getStatus(),
        ];
    }
}
