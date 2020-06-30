<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Client;

use ARNTech\GuzzlePoolClient\Pool\DynamicPool;
use ARNTech\GuzzlePoolClient\Traits\ClientPromiseAdd;
use GuzzleHttp\Client;

/**
 * Class DynamicPoolClient
 * @package ARNTech\GuzzlePoolClient\Cient
 */
class DynamicPoolClient extends AbstractPoolClient
{
    use ClientPromiseAdd;

    /**
     * DynamicPoolClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['pool'])) {
            if (!$config['pool'] instanceof DynamicPool) {
                throw new \InvalidArgumentException('Specified pool must be instance of ARNTech\GuzzlePoolClient\Pool\DynamicPool.');
            }
        } else {
            if (empty($config['pool_size'])) {
                $config['pool_size'] = 100;
            }
            $config['pool'] = new DynamicPool($config['pool_size'], []);
            unset($config['pool_size']);
        }

        parent::__construct($config);
    }
}