<?php

namespace App\Application\Param\Dto;

class Param implements ParamInterface
{
    /** @var array */
    private array $params = [];

    /**
     * @param $param
     * @param $value
     */
    public function setParam($param, $value)
    {
        $this->params[$param] = $value;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}