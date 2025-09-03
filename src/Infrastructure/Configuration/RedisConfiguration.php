<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Configuration;

use Raketa\BackendTestTask\Application\Contracts\ConfigurationInterface;

class RedisConfiguration implements ConfigurationInterface
{
    private array $config;

    public function __construct()
    {
        $this->config = [
            'host' => '127.0.0.1',
            'port' => 6379,
            'password' => null,
            'db_index' => 1,
        ];
    }

    public function get(): array
    {
        return $this->config;
    }
}