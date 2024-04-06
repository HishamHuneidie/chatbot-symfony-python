<?php

namespace App\Service\HttpClient;

use App\Enum\HttpVerb;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CustomClient
{

    private const DEFAULT_TIMEOUT = 120;

    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly LoggerInterface     $logger,
    )
    {
    }

    public function get(string $path, array $queryParams = []): ?string
    {
        try {
            $response = $this->client->request(HttpVerb::GET->name, $path, [
                'query' => $queryParams,
                'timeout' => self::DEFAULT_TIMEOUT,
            ]);

            return $response->getContent();
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|ClientExceptionInterface$e) {
            $this->logger->error(HttpVerb::GET->name, [$path, $queryParams, $e->getMessage()]);
        }

        return null;
    }

    public function post(string $path, string $rawBody = ''): ?string
    {
        try {
            $response = $this->client->request(HttpVerb::POST->name, $path, [
                'body' => $rawBody,
                'header' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => self::DEFAULT_TIMEOUT,
            ]);

            return $response->getContent();
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|ClientExceptionInterface$e) {
            $this->logger->error(HttpVerb::POST->name, [$path, $rawBody, $e->getMessage()]);
        }

        return null;
    }

    public function put(string $path, string $rawBody = ''): ?string
    {
        try {
            $response = $this->client->request(HttpVerb::PUT->name, $path, [
                'body' => $rawBody,
                'header' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => self::DEFAULT_TIMEOUT,
            ]);

            return $response->getContent();
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|ClientExceptionInterface$e) {
            $this->logger->error(HttpVerb::PUT->name, [$path, $rawBody, $e->getMessage()]);
        }

        return null;
    }

    public function delete(string $path, string $rawBody = ''): ?string
    {
        try {
            $response = $this->client->request(HttpVerb::DELETE->name, $path, [
                'body' => $rawBody,
                'header' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => self::DEFAULT_TIMEOUT,
            ]);

            return $response->getContent();
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|ClientExceptionInterface$e) {
            $this->logger->error(HttpVerb::DELETE->name, [$path, $rawBody, $e->getMessage()]);
        }

        return null;
    }
}