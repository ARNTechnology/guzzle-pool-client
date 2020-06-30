<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use GuzzleHttp\Promise\PromiseInterface;

/**
 * Trait ClientPromiseAdd
 * @package ARNTech\GuzzlePoolClient\Traits
 */
trait ClientPromiseAdd
{
    /**
     * @param PromiseInterface $promise
     */
    public function add(PromiseInterface $promise)
    {
        $this->pool->add($promise);
    }
}