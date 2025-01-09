<?php

namespace App\Infrastructure\Doctrine\Event;

use Doctrine\ORM\Mapping as ORM;
use LogicException;

trait PreventRemove
{
    /**
     * @ORM\PreRemove
     */
    public function onPreRemove()
    {
        throw new LogicException('Cannot be remove');
    }
}