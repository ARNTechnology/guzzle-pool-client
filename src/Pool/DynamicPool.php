<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Pool;


use ARNTech\GuzzlePoolClient\Traits\DynamicPoolTrait;
use ARNTech\Utils\Iterator\ExpectingIterator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Promise\each_limit;


class DynamicPool extends AbstractPool implements PromisorInterface
{
    use DynamicPoolTrait;

    public function promise()
    {
        return each_limit($this->generator, $this->poolSize);
    }
}