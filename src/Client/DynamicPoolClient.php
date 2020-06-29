<?php
/**
 * Copyright (c) 2020
 * Alexandru Negrilã (alex-codes@arntech.ro) - ARN TECHNOLOGY
 */

namespace ARNTech\GuzzlePoolClient\Cient;

use ARNTech\GuzzlePoolClient\Pool\DynamicPool;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromisorInterface;

class DynamicPoolClient extends AbstractPoolClient
{
    /**
     * DynamicPoolClient constructor.
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['pool'])) {
            if (!$config['pool'] instanceof PromisorInterface) {
                throw new \InvalidArgumentException('Specified pool must be instance of GuzzleHttp\Promise\PromisorInterface.');
            }
        } else {
            if (empty($config['pool_size'])) {
                $config['pool_size'] = 100;
            }
            $config['pool'] = new DynamicPool($config['pool_size']);
            unset($config['pool_size']);
        }
        parent::__construct($config);
    }
}