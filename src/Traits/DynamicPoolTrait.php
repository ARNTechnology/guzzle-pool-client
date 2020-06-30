<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Traits;


use ARNTech\Utils\Iterator\ExpectingIterator;
use ARNTech\Utils\Iterator\MapIterator;

trait DynamicPoolTrait
{
    use PoolTrait;

    /**
     * @var ExpectingIterator
     */
    protected $generator;

    public function reset()
    {
        $this->workload = new \ArrayIterator();
        $generator = new MapIterator($this->workload);
        $this->generator = new ExpectingIterator($generator);
    }
}