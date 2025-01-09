<?php

namespace App\Repository;

use App\Application\Paste\PasteRepositoryInterface;
use App\Entity\Paste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paste[]    findAll()
 * @method Paste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasteRepository extends ServiceEntityRepository implements PasteRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paste::class);
    }

    public function getByHash(string $hash): ?Paste
    {
        return $this->findOneBy(['hash' => $hash]);
    }
}
