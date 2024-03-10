<?php

namespace App\Tests\Unit\Domain\Repository;

use App\Domain\Entity\UserEntity;
use App\Domain\Repository\UserEntityRepository;
use App\Tests\Unit\UnitTestCase;

class UserEntityRepositoryTest extends UnitTestCase
{
    protected UserEntityRepository $repository;
    protected UserEntity $testEntity;
    public function setUp(): void
    {
        parent::setUp();
        $entity = new UserEntity(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $entity->setId(1);
        $this->testEntity = $entity;

        $this->repository = $this->createMock(UserEntityRepository::class);

        $this->repository
            ->method('getById')
            ->with(1)
            ->willReturn($entity);

        $this->repository
            ->method('save')
            ->with($entity)
            ->willReturn($entity);

        $this->repository
            ->method('getAll')
            ->willReturn([$entity]);

        $this->repository
            ->method('findByEmail')
            ->with(self::EMAIL)
            ->willReturn($entity);
    }

    public function testGetByValidIdReturnsUserEntity()
    {
        $this->assertSame($this->testEntity, $this->repository->getById(1));
        $this->assertTrue($this->repository->getById(1) instanceof UserEntity);
    }

    public function testSaveReturnsUserEntity()
    {
        $this->assertSame($this->testEntity, $this->repository->save($this->testEntity));
        $this->assertTrue($this->repository->getById(1) instanceof UserEntity);
    }

    public function testGetAllReturnsArray()
    {
        $this->assertSame([$this->testEntity], $this->repository->getAll());
    }

    public function testFindByEmailReturnsUserEntity()
    {
        $this->assertSame($this->testEntity, $this->repository->findByEmail(self::EMAIL));
    }
}
