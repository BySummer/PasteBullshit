<?php

namespace App\Infrastructure\Doctrine\Column;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait CreatedAt
 * @package App\Infrastructure\Doctrine\Column
 */
trait CreatedAt
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $createdAt;

    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistCreatedAt()
    {
        if (!$this->createdAt) {
            $this->createdAt = new DateTime();
        }
    }
}