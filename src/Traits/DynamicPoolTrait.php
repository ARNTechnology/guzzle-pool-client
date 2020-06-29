<?php


namespace ARNTech\GuzzlePoolClient\Traits;


use ARNTech\Utils\Iterator\ExpectingIterator;
use ARNTech\Utils\Iterator\MapIterator;

trait DynamicPoolTrait
{
    use PoolTrait;

    /**
     * @var ExpectingIterator
     */
    private $generator;

    public function reset()
    {
        $this->workload = new \ArrayIterator();
        $generator = new MapIterator($this->workload);
        $this->generator = new ExpectingIterator($generator);
    }
}