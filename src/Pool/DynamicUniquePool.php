<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Pool;

use ARNTech\Utils\Iterator\ExpectingIterator;
use ARNTech\Utils\Iterator\MapIterator;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Promise\each_limit;

/**
 * Class DynamicUniquePool
 * @package ARNTech\GuzzlePoolClient\Pool
 */
class DynamicUniquePool implements PromisorInterface
{
    /**
     * @var \ArrayIterator
     */
    protected $workload;

    /**
     * @var ExpectingIterator
     */
    protected $generator;

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
                $this->add($request, $request->getUri());
            }
        }
    }

    /**
     * Runs wait on the pool
     */
    public function wait()
    {
        $this->promise()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function promise()
    {
        return each_limit($this->generator, $this->poolSize);
    }

    /**
     * @param RequestInterface $promise
     */
    public function add(PromiseInterface $promise, string $key)
    {
        if (!$this->workload->offsetExists($key)) {
            $this->workload->offsetSet($key, $promise);
        } else {
            $promise->cancel();
        }
    }

    /**
     * Resets current pool
     */
    public function reset()
    {
        $this->workload = new \ArrayIterator();
        $generator = new MapIterator($this->workload);
        $this->generator = new ExpectingIterator($generator);
    }
}