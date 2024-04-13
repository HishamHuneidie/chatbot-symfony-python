<?php

namespace App\Model\Chat\Connector;

class Response
{

    public function __construct(
        private readonly string $answer,
    ) {}

    public function getAnswer(): string
    {
        return $this->answer;
    }
}