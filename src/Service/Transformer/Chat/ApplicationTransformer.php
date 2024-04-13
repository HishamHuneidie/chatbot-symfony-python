<?php

namespace App\Service\Transformer\Chat;

use App\Model\Chat\Application\Request as ApplicationRequest;
use App\Model\Chat\Application\Response as ApplicationResponse;
use App\Model\Chat\Connector\Request as ConnectorRequest;
use App\Model\Chat\Connector\Response as ConnectorResponse;

class ApplicationTransformer
{

    public function toConnector(ApplicationRequest $request): ConnectorRequest
    {
        return new ConnectorRequest(
            $request->getMessage(),
            $request->getKey(),
        );
    }

    public function fromConnector(ConnectorResponse $response): ApplicationResponse
    {
        return new ApplicationResponse(
            $response->getAnswer(),
        );
    }

}