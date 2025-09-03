<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Infrastructure\Cache;

use Raketa\BackendTestTask\Application\Contracts\CacheConnectorInterface;
use Raketa\BackendTestTask\Application\Contracts\SerializableInstance;
use Raketa\BackendTestTask\Infrastructure\Exceptions\ConnectorException;
use RedisException;
use Redis;

class RedisCacheConnector implements CacheConnectorInterface
{
    private Redis $redis;

    public function __construct(Redis $redis)
    {
        return $this->redis = $redis;
    }

    /**
     * @throws ConnectorException
     */
    public function get(string $key)
    {
        try {
            return unserialize($this->redis->get($key));
        } catch (RedisException $e) {
            throw new ConnectorException('Connector error', $e->getCode(), $e);
        }
    }

    /**
     * @throws ConnectorException
     */
    public function set(string $key, SerializableInstance $value)
    {
        try {
            $this->redis->setex($key, 24 * 60 * 60, serialize($value));
        } catch (RedisException $e) {
            throw new ConnectorException('Connector error', $e->getCode(), $e);
        }
    }

    public function has($key): bool
    {
        return $this->redis->exists($key);
    }
}
