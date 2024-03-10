<?php

namespace App\Domain\Repository;

use App\Domain\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserEntity>
 *
 * @method UserEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEntity[]    findAll()
 * @method UserEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEntityRepository extends ServiceEntityRepository implements UserEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    public function getById(int $id): ?UserEntity
    {
        return $this->find($id);
    }

    public function save(UserEntity $userEntity): UserEntity
    {
        $this->getEntityManager()->persist($userEntity);
        $this->getEntityManager()->flush();

        return $userEntity;
    }

    public function delete(UserEntity $userEntity): void
    {
        $this->getEntityManager()->remove($userEntity);
        $this->getEntityManager()->flush();
    }

    public function findByEmail(string $email): ?UserEntity
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :val')
            ->setParameter('val', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
