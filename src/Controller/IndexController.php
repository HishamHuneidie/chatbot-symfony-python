<?php

namespace App\Controller;

use App\Application\IndexApplication;
use App\Service\HttpClient\PythonConnector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    private IndexApplication $application;

    public function __construct(IndexApplication $application)
    {
        $this->application = $application;
    }

    #[Route('/', name: 'app_index')]
    public function index(PythonConnector $connector): Response
    {
        //$response = $this->application->work();
        return $this->render('index/index.html.twig', [
            "name" => "Hisham"
        ]);
    }
}
