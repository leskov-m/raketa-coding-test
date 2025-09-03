<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Factory;

use Raketa\BackendTestTask\Application\Contracts\CacheConnectorInterface;
use Raketa\BackendTestTask\Infrastructure\Cache\RedisCacheConnector;

class CacheConnectorFactory
{
    public static function create(): CacheConnectorInterface
    {
        $redis = new \Redis();
        return new RedisCacheConnector($redis);
    }
}