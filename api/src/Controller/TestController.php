<?php

namespace App\Controller;

use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(
        HubInterface $hub,
        // IriConverterInterface $iriConverter,
        SerializerInterface $serializer,
    ): JsonResponse {

        $update = new Update(
            // $this->iriConverter->getIriFromResource($data),
            'http://localhost:8000/api/posts/1',
            // $this->serializer->serialize($data, 'json')
            json_encode([
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestController.php',
            ])
            // $this->serializer->serialize($data, 'json')
        );
        $hub->publish($update);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
