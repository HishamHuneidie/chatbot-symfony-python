<?php

namespace App\Model\Chat\Application;

class Request
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
}