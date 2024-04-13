<?php

namespace App\Application;

use App\Exception\Connector\ConnectorResponseException;
use App\Model\Chat\Application\Request;
use App\Model\Chat\Application\Response;
use App\Service\Connector\PythonConnector;
use App\Service\Transformer\Chat\ApplicationTransformer;

class ChatApplication extends AbstractApplication
{

    public function __construct(
        private readonly PythonConnector        $connector,
        private readonly ApplicationTransformer $transformer,
    ) {}

    /**
     * @throws ConnectorResponseException
     */
    public function ask(Request $request): Response
    {
        $connectorRequest = $this->transformer->toConnector($request);

        $connectorResponse = $this->connector->ask($connectorRequest);

        return $this->transformer->fromConnector($connectorResponse);
    }
}