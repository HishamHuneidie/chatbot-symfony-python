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

    public function work(): mixed
    {
        $test = $this->connector->getTest();
        $chat = $this->connector->getChat();
        return null;
    }
}