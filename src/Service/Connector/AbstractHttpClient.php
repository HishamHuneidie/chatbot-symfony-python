<?php

namespace App\Service\Connector;

use App\Exception\Connector\ConnectorResponseException;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use JsonSerializable;

class AbstractHttpClient
{
    private Serializer $serializer;

    public function __construct(
        private readonly CustomClient $client,
    )
    {
        $this->serializer = $this->initSerializer();
    }

    private function initSerializer(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        return new Serializer(
            [
                new ObjectNormalizer(
                    $classMetadataFactory,
                    $metadataAwareNameConverter,
                    null,
                    new ReflectionExtractor(),
                ),
                new ArrayDenormalizer(),
            ], [
                'json' => new JsonEncoder(),
            ],
        );
    }

    private function deserializeResponse(?string $responseJson, string $responseDataType): mixed
    {
        if (empty($responseJson)) {
            return null;
        }
        if ($responseDataType === 'array') {
            return $this->serializer->decode($responseJson, 'json');
        }
        return $this->serializer->deserialize($responseJson, $responseDataType, 'json');
    }

    // ---------------------------- HTTP requests ----------------------------
    // ---------------------------- HTTP requests ----------------------------
    // ---------------------------- HTTP requests ----------------------------

    protected function doGet(string $path, string $responseDataType, JsonSerializable $request): mixed
    {
        $responseJson = $this->client->get($path, $request->jsonSerialize());
        return $this->deserializeResponse($responseJson, $responseDataType);
    }

    protected function doPost(string $path, string $responseDataType, JsonSerializable $request): mixed
    {
        return null;
    }

    protected function doPut(string $path, string $responseDataType, JsonSerializable $request): mixed
    {
        return null;
    }

    protected function doDelete(string $path, string $responseDataType, JsonSerializable $request): mixed
    {
        return null;
    }

    // ---------------------------- Protected methods ----------------------------
    // ---------------------------- Protected methods ----------------------------
    // ---------------------------- Protected methods ----------------------------

    /**
     * @throws ConnectorResponseException
     */
    protected function validateResponse(mixed $response): bool
    {
        if (is_null($response)) {
            throw new ConnectorResponseException("Response is empty");
        }

        return true;
    }
}