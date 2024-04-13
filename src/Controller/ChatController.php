<?php

namespace App\Controller;

use App\Application\ChatApplication;
use App\Enum\HttpStatus;
use App\Exception\Connector\ConnectorResponseException;
use App\Model\ErrorResponse;
use App\Service\Transformer\Chat\ControllerTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ChatController extends AbstractController
{
    private ChatApplication       $application;
    private ControllerTransformer $transformer;

    public function __construct(
        ChatApplication       $application,
        ControllerTransformer $transformer,
    )
    {
        $this->application = $application;
        $this->transformer = $transformer;
    }

    #[Route('/chat/ask-ajax', name: 'app_chat_analyzer')]
    public function analyze(Request $request): JsonResponse
    {
        $applicationRequest = $this->transformer->toApplication($request);

        try {
            $applicationResponse = $this->application->ask($applicationRequest);
        } catch (ConnectorResponseException $e) {
            $errorResponse = new ErrorResponse("Error asking to chat, please try again", HttpStatus::BAD_REQUEST->value);
            return $this->json($errorResponse);
        }

        return $this->json($this->transformer->fromApplication($applicationResponse));
    }
}
