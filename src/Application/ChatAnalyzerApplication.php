<?php

namespace App\Application;

use App\Service\HttpClient\PythonConnector;

class ChatAnalyzerApplication extends AbstractApplication
{

    public function __construct(
        private readonly PythonConnector $connector,
    )
    {
    }

    public function work(string $message): mixed
    {
        return $this->connector->getTest($message);
    }
}