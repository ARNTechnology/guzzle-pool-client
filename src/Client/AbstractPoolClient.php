<?php


namespace ARNTech\GuzzlePoolClient\Cient;


use ARNTech\GuzzlePoolClient\Pool\AbstractPool;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;

abstract class AbstractPoolClient extends Client
{
    /**
     * @var AbstractPool
     */
    private $pool;

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

    public function send(RequestInterface $request, array $options = [])
    {
        throw new \Exception("Sync calls can not be done with a PoolClient");
    }

    public function request($method, $uri = '', array $options = [])
    {
        throw new \Exception("Sync calls can not be done with a PoolClient");
    }
    public function add(PromiseInterface $promise)
    {
        $this->pool->add($promise);
    }

    public function wait()
    {
        return $this->pool->wait();
    }

}