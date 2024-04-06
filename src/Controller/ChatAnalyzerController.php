<?php

namespace App\Controller;

use App\Application\ChatAnalyzerApplication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ChatAnalyzerController extends AbstractController
{
    private ChatAnalyzerApplication $application;

    public function __construct(ChatAnalyzerApplication $application)
    {
        $this->application = $application;
    }

    #[Route('/analyzer/ask-ajax', name: 'app_chat_analyzer')]
    public function analyze(Request $request): JsonResponse
    {
        $message = $request->request->get("message");
        $idKey = $request->request->get("idKey");
        $response = $this->application->work($message);
        return $this->json([
            "message" => $response['message'] ?? "Empty message...",
            "idKey" => $idKey,
        ]);
    }
}
