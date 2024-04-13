<?php

namespace App\Service\Connector;

use App\Exception\Connector\ConnectorResponseException;
use App\Model\Chat\Connector\Request;
use App\Model\Chat\Connector\Response;

class PythonConnector extends AbstractHttpClient
{
    const PYTHON_PATH = 'http://flask:5000';

    /**
     * @throws ConnectorResponseException
     */
    public function ask(Request $request): Response
    {
        $path = self::PYTHON_PATH . "/chat";
        $response = $this->doGet($path, Response::class, $request);

        $this->validateResponse($response);

        return $response;
    }
}