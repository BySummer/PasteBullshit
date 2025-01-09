<?php

namespace App\Application\Paste;

use App\Application\Paste\Dto\PasteInterface;
use App\Application\Paste\Exception\PasteManagerException;
use App\Application\Uuid\UuidGeneratorInterface;
use App\Entity\Paste;
use DateTimeInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class PasteManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UuidGeneratorInterface $uuidGenerator
    ) {
    }

    /**
     * @throws PasteManagerException
     */
    public function create(PasteInterface $pasteDto): Paste
    {
        $paste = new Paste();
        $paste->setName($pasteDto->getName());
        $paste->setContent($pasteDto->getContent());
        $paste->setVisibility($pasteDto->getVisibility());
        $paste->setSyntax($pasteDto->getSyntax());
        $paste->setUuid($this->uuidGenerator->generate());
        $paste->setExpiredAt($this->getExpiredAtByLifetime($pasteDto->getLifetime()));

        try {
            $this->entityManager->persist($paste);
            $this->entityManager->flush();
        } catch (Throwable $e) {
            throw new PasteManagerException('Ошибка создания пасты', 0, $e);
        }

        return $paste;
    }

    private function getExpiredAtByLifetime(int $lifetime): ?DateTimeInterface
    {
        return match ($lifetime) {
            PasteModel::ONE_HOUR_LIFETIME  => new DateTime('+1 hour'),
            PasteModel::ONE_DAY_LIFETIME   => new DateTime('+1 day'),
            PasteModel::ONE_WEEK_LIFETIME  => new DateTime('+1 week'),
            PasteModel::ONE_MONTH_LIFETIME => new DateTime('+1 month'),
            default                        => null,
        };
    }
}