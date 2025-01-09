<?php

namespace App\Infrastructure\Doctrine\Event;

use Doctrine\ORM\Mapping as ORM;
use LogicException;

trait PreventUpdate
{
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        throw new LogicException('Cannot update');
    }
}