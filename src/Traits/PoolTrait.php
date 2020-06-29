<?php


namespace ARNTech\GuzzlePoolClient\Traits;


use Psr\Http\Message\RequestInterface;

trait PoolTrait
{
    /**
     * @param RequestInterface $request
     */
    public function add(RequestInterface $request)
    {
        $this->workload->append($request);
    }

    public function reset()
    {
        $this->workload = new \ArrayIterator();
    }
}