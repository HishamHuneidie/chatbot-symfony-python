<?php

namespace App\Service\HttpClient;

class PythonConnector extends AbstractHttpClient
{
    const PYTHON_PATH = 'http://flask:5000';

    public function getTest(string $question): mixed
    {
        $path = self::PYTHON_PATH . "/";
        return $this->doGet($path, 'array', [
            'question' => $question,
        ]);
    }

    public function getChat(): mixed
    {
        $path = self::PYTHON_PATH . "/chat";
        return $this->doGet($path, 'array');
    }
}