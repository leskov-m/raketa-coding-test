<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Service;

use Raketa\BackendTestTask\Application\Contracts\CacheServiceInterface;
use Raketa\BackendTestTask\Application\Contracts\ConfigurationInterface;
use Raketa\BackendTestTask\Application\Contracts\CacheConnectorInterface;
use Raketa\BackendTestTask\Infrastructure\Cache\RedisCacheConnector;
use RedisException;
use Redis;

class RedisService implements CacheServiceInterface
{
    public CacheConnectorInterface $connector;
    private ConfigurationInterface $config;
    private bool $isConnected = false;

    public function __construct(CacheConnectorInterface $connector, ConfigurationInterface $config)
    {
        $this->connector = $connector;
        $this->config = $config;
    }

    public function getConnector(): CacheConnectorInterface
    {
        $this->failIfNotConnected();
        return $this->connector;
    }

    public function connect(): void
    {
        $redis = new Redis();

        try {
            $this->isConnected = $redis->isConnected();
            if (! $this->isConnected && $redis->ping('Pong')) {
                $this->isConnected = $redis->connect(
                    $this->config['host'],
                    $this->config['port'],
                );
            }
        } catch (RedisException) {
        }

        $this->failIfNotConnected();

        $redis->auth($this->config['password']);
        $redis->select($this->config['db_index']);
        $this->connector = new RedisCacheConnector($redis);
    }

    private function failIfNotConnected(): void
    {
        if (!$this->isConnected) {
            throw new RedisException('Connection failed');
        }
    }
}
