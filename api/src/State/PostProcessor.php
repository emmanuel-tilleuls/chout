<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post as PostOperation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Post;
use Elastica\Document;
use FOS\ElasticaBundle\Elastica\Index;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Uuid;

class PostProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly Index $postIndex,
        private readonly NormalizerInterface $normalizer,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if (!$operation instanceof PostOperation) {
            throw new \LogicException('Should not be here');
        }

        if (!$data instanceof Post) {
            throw new \LogicException('Should not be here');
        }

        $id = Uuid::v7();

        $data->setId($id);

        $document = new Document($id, $this->normalizer->normalize($data));
        $this->postIndex->addDocument($document);

        return $data;
    }
}