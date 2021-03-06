<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Pool;


use ARNTech\GuzzlePoolClient\Traits\DynamicPoolTrait;
use ARNTech\Utils\Iterator\ExpectingIterator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Promise\each_limit;


/**
 * Class DynamicPool
 * @package ARNTech\GuzzlePoolClient\Pool
 */
class DynamicPool extends AbstractPool implements PromisorInterface
{
    use DynamicPoolTrait;

    /**
     * @return PromiseInterface
     */
    public function promise()
    {
        return each_limit($this->generator, $this->poolSize);
    }
}