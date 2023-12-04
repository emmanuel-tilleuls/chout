<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Post;
use Elastica\Query;
use FOS\ElasticaBundle\Elastica\Index;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PostProvider implements ProviderInterface
{
    public function __construct(
        private readonly Index $postIndex,
        private readonly DenormalizerInterface $denormalizer,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Post|array|null
    {
        if (!$operation instanceof GetCollection) {
            throw new \LogicException('Should not be here');
        }

        $searchResults = $this->postIndex->search([]);

        $result = [];
        foreach ($searchResults->getDocuments() as $document) {
            $result[] = $this->denormalizer->denormalize($document->getData(), Post::class);
        }

        return $result;
    }
}
