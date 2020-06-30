<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Trait PoolTrait
 * @package ARNTech\GuzzlePoolClient\Traits
 */
trait PoolTrait
{
    /**
     * @param RequestInterface $request
     */
    public function add(PromiseInterface $request)
    {
        $this->workload->append($request);
    }

    /**
     * Resets the pool/workload
     */
    public function reset()
    {
        $this->workload = new \ArrayIterator();
    }
}