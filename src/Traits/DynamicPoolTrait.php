<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use ARNTech\Utils\Iterator\ExpectingIterator;
use ARNTech\Utils\Iterator\MapIterator;

/**
 * Trait DynamicPoolTrait
 * @package ARNTech\GuzzlePoolClient\Traits
 */
trait DynamicPoolTrait
{
    use PoolTrait;

    /**
     * @var ExpectingIterator
     */
    protected $generator;

    /**
     * Resets the pool/workload
     */
    public function reset()
    {
        $this->workload = new \ArrayIterator();
        $generator = new MapIterator($this->workload);
        $this->generator = new ExpectingIterator($generator);
    }
}