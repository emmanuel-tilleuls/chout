<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post as PostOperation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Post;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PostProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ProcessorInterface $persistProcessor,
        private readonly HubInterface $hub,
        private readonly UrlGeneratorInterface $urlGenerator,

        private readonly SerializerInterface $serializer,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ?Post
    {
        if (!$operation instanceof PostOperation) {
            throw new \LogicException();
        }

        if (!$data instanceof Post) {
            throw new \LogicException();
        }

        $this->persistProcessor->process($data, $operation, $uriVariables, $context);

        $update = new Update(
            $this->urlGenerator->generate('_api_/posts{._format}_get_collection', [], UrlGeneratorInterface::ABSOLUTE_URL),
            $this->serializer->serialize($data, 'json')
        );
        $this->hub->publish($update);

        return $data;
    }
}
