<?php

namespace App\Model\Chat\Connector;

use JsonSerializable;

class Request implements JsonSerializable
{

    public function __construct(
        private readonly string $message,
        private readonly string $key,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function jsonSerialize(): array
    {
        return [
            "message" => $this->getMessage(),
            "key"     => $this->getKey(),
        ];
    }
}