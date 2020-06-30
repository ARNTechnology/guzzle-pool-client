<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Client;


use ARNTech\GuzzlePoolClient\Pool\AbstractPool;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class AbstractPoolClient
 * @package ARNTech\GuzzlePoolClient\Cient
 */
abstract class AbstractPoolClient extends Client
{
    /**
     * @var AbstractPool
     */
    protected $pool;

    /**
     * @var bool
     */
    protected $waits = false;

    /**
     * AbstractPoolClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (empty($config['pool'])) {
            throw new \InvalidArgumentException('PoolClient must have pool parameter in config');
        }
        if (!$config['pool'] instanceof PromisorInterface) {
            throw new \InvalidArgumentException('Specified pool must be instance of GuzzleHttp\Promise\PromisorInterface.');
        }
        $this->pool = $config['pool'];
        unset($config['pool']);
        parent::__construct($config);
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface|void
     * @throws \Exception
     */
    public function send(RequestInterface $request, array $options = [])
    {
        throw new \Exception("Sync calls can not be done with a PoolClient");
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface|void
     * @throws \Exception
     */
    public function request($method, $uri = '', array $options = [])
    {
        throw new \Exception("Sync calls can not be done with a PoolClient");
    }

    /**
     * Runs wait on the pool
     */
    public function wait()
    {
        //checking if wait was already run in order to prevent processing the elements again
        //adding this test here for people lazy like me that don't want to check every time if wait was called or not
        if (!$this->waits) {
            $this->waits = true;
            return $this->pool->wait();
        }
    }

    /**
     * Resets the current pool
     */
    public function reset()
    {
        $this->waits = false;
        $this->pool->reset();
    }

}