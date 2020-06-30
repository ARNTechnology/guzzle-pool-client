<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use GuzzleHttp\Promise\PromiseInterface;

trait ClientPromiseAdd
{
    public function add(PromiseInterface $promise)
    {
        $this->pool->add($promise);
    }
}