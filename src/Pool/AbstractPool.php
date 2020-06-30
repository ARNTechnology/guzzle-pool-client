<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Pool;


use ARNTech\GuzzlePoolClient\Traits\PoolTrait;
use Psr\Http\Message\RequestInterface;

abstract class AbstractPool
{
    use PoolTrait;

    /**
     * @var \ArrayIterator
     */
    protected $workload;

    /**
     * @var int
     */
    protected $poolSize;

    /**
     * DynamicPool constructor.
     * @param int $poolSize
     * @param iterable|RequestInterface[] $requests
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(int $poolSize, ?iterable $requests)
    {
        if (!empty($requests) && !is_iterable($requests)) {
            throw new \InvalidArgumentException("Requests must be iterable.");
        }
        $this->reset();
        if (!empty($requests)) {
            foreach ($requests as $request) {
                $this->add($request);
            }
        }
    }
    abstract function promise();

    public function wait()
    {
        $this->promise()->wait();
    }
}