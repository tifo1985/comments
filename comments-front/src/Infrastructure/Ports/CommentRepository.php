<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports;

use App\Domain\Entity\Comment;
use App\Domain\Entity\User;
use App\Domain\Gateway\CommentGateway;
use App\UserInterface\Traits\TokenStorageTraits;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CommentRepository implements CommentGateway
{
    use TokenStorageTraits;
    private const BASE_URL = 'http://comments-api-nginx/api/';

    public function __construct(
        readonly private HttpClientInterface $client,
        readonly private SerializerInterface $serializer,
        readonly private JWTTokenManagerInterface $JWTTokenManager
    ) {
    }

    public function create(Comment $comment): Comment
    {
        $response = $this->client->request(
            Request::METHOD_POST,
            self::BASE_URL.'comments/',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->JWTTokenManager->create($this->tokenStorage->getToken()->getUser()),
                ],
                'json' => array_filter([
                  'message' => $comment->getMessage(),
                  'external_content_id' => $comment->getArticleId(),
                  'parent_id' => $comment->getParent()?->getId(),
                ]),
            ]
        );

        $commentData = \json_decode($response->getContent(), true);
        $comment->setId($commentData['id'])
            ->setCreatedAt(new \DateTime($commentData['created_at']));

        return $comment;
    }

    public function findByArticle(string $articleId, int $maxResult): array
    {
        $response = $this->client->request(
            Request::METHOD_GET,
            self::BASE_URL.'contents/'.$articleId.'/comments/'
        );

        return $this->serializer->deserialize($response->getContent(), Comment::class.'[]', 'json');
    }

    private function getJwtToken(User $user): string
    {
    }
}
