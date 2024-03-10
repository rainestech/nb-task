<?php

namespace App\Infrastructure\Domain\Commands\Users;

use App\Domain\Entity\UserEntity;
use App\Domain\Repository\UserEntityRepository;
use App\Infrastructure\Domain\Exception\EmailNotUniqueException;
use App\Infrastructure\Transformers\UserDataTransformer;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateUserCommandHandler
{

    public function __construct(private UserEntityRepository $repository) {

    }

    /**
     * @throws EmailNotUniqueException
     */
    public function __invoke(CreateUserCommand $command): UserEntity
    {
        $entity = UserDataTransformer::toEntity($command);
        $this->checkUniqueEmail($entity->getEmail());
        $this->repository->save($entity);

        return $entity;
    }

    /**
     * @throws EmailNotUniqueException
     */
    private function checkUniqueEmail(string $email): void
    {
        if ($this->repository->findByEmail($email)) {
            throw new EmailNotUniqueException('Email already exists');
        }
    }
}
