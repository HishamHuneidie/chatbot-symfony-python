<?php

namespace App\Service\Transformer\Chat;

use App\Model\Chat\Application\Request as ApplicationRequest;
use App\Model\Chat\Application\Response as ApplicationResponse;
use App\Model\Chat\Controller\Response as ControllerResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class ControllerTransformer
{

    public function toApplication(HttpRequest $request): ApplicationRequest
    {
        return new ApplicationRequest(
            $request->get('message') ?? '',
            $request->get('key') ?? '',
        );
    }

    public function fromApplication(ApplicationResponse $response): ControllerResponse
    {
        return new ControllerResponse($response->getAnswer());
    }
}