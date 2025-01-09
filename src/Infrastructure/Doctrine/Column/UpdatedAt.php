<?php

namespace App\Infrastructure\Doctrine\Column;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait UpdatedAt
 * @package App\Infrastructure\Doctrine\Column
 */
trait UpdatedAt
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $updatedAt;

    public function getUpdatedAt() : DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function onPreUpdateUpdatedAt()
    {
        $this->updatedAt = new DateTime();
    }
}