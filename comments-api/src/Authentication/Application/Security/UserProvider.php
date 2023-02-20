<?php

declare(strict_types=1);

namespace App\Authentication\Application\Security;

use App\Authentication\Domain\Entity\Author;
use App\Authentication\Domain\Entity\Email;
use App\Authentication\Domain\Entity\Name;
use App\Authentication\Domain\Entity\Url;
use App\Authentication\Domain\Entity\UserId;
use App\Authentication\Domain\Repository\AuthorRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\PayloadAwareUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method UserInterface loadUserByIdentifierAndPayload(string $identifier, array $payload)
 */
class UserProvider implements PayloadAwareUserProviderInterface
{
    public function __construct(private readonly AuthorRepositoryInterface $authorRepository)
    {
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass(string $class)
    {
        return Author::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->authorRepository->findById($identifier);
    }

    public function loadUserByUsernameAndPayload(string $username, array $payload)
    {
        try {
            $author = $this->loadUserByIdentifier($payload['id']);
        } catch (\Throwable $exception) {
            $author = $this->authorRepository->create(new Author(
                new UserId($payload['id']),
                new Email($payload['username']),
                new Name($payload['name']),
                new Url($payload['avatar'])
            ));
        }

        return $author;
    }
}
