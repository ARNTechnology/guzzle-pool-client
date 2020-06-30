<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use GuzzleHttp\Promise\PromiseInterface;

/**
 * Trait ClientUniquePromiseAdd
 * @package ARNTech\GuzzlePoolClient\Traits
 */
trait ClientUniquePromiseAdd
{
    /**
     * @param PromiseInterface $promise
     * @param string $key
     */
    public function add(PromiseInterface $promise, string $key)
    {
        $this->pool->add($promise, $key);
    }
}