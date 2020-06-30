<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Pool;


use ARNTech\GuzzlePoolClient\Traits\PoolTrait;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class AbstractPool
 * @package ARNTech\GuzzlePoolClient\Pool
 */
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

    /**
     * @return PromiseInterface
     */
    abstract function promise();

    /**
     * Runs wait on the pool
     */
    public function wait()
    {
        $this->promise()->wait();
    }
}