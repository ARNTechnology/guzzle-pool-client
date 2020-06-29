<?php


namespace ARNTech\GuzzlePoolClient\Traits;


use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

trait PoolTrait
{
    /**
     * @param RequestInterface $request
     */
    public function add(PromiseInterface $request)
    {
        $this->workload->append($request);
    }

    public function reset()
    {
        $this->workload = new \ArrayIterator();
    }
}