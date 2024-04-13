<?php

namespace App\Model\Chat\Controller;

use JsonSerializable;

class Response implements JsonSerializable
{

    public function __construct(
        private readonly string $answer,
    ) {}

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function jsonSerialize(): array
    {
        return [
            "answer" => $this->getAnswer(),
        ];
    }
}