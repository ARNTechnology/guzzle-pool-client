<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Client;

use ARNTech\GuzzlePoolClient\Pool\DynamicUniquePool;
use ARNTech\GuzzlePoolClient\Traits\ClientUniquePromiseAdd;
use GuzzleHttp\Promise\Promise;

/**
 * Class DynamicUniquePoolClient
 * @package ARNTech\GuzzlePoolClient\Client
 */
class DynamicUniquePoolClient extends AbstractPoolClient
{
    use ClientUniquePromiseAdd;

    /**
     * DynamicUniquePoolClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['pool'])) {
            if (!$config['pool'] instanceof DynamicUniquePool) {
                throw new \InvalidArgumentException('Specified pool must be instance of ARNTech\GuzzlePoolClient\Pool\DynamicPool.');
            }
        } else {
            if (empty($config['pool_size'])) {
                $config['pool_size'] = 100;
            }
            $config['pool'] = new DynamicUniquePool($config['pool_size'], []);
            unset($config['pool_size']);
        }
        parent::__construct($config);
    }
}