<?php


namespace ARNTech\GuzzlePoolClient\Traits;


use ARNTech\Utils\Iterator\ExpectingIterator;

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