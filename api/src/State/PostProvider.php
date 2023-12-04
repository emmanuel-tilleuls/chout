<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Post;

class PostProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Post|array|null
    {
        return (new Post())
            ->setId('my-id')
            ->setAuthor('John')
            ->setMessage('lorem ipsum')
            ->setCreatedAt(new \DateTimeImmutable('-1 day'))
        ;
    }
}
