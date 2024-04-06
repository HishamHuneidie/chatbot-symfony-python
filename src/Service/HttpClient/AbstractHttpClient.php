<?php

namespace App\Service\HttpClient;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AbstractHttpClient
{
    // TODO: Create a custom client to catch exceptions
    private Serializer $serializer;

    public function __construct(
        private readonly CustomClient $client
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
                    new ReflectionExtractor()
                ),
                new ArrayDenormalizer(),
            ], [
                'json' => new JsonEncoder(),
            ]
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

    protected function doGet(string $path, string $responseDataType, array $queryParams = []): mixed
    {
        $responseJson = $this->client->get($path, $queryParams);
        return $this->deserializeResponse($responseJson, $responseDataType);
    }
}