<?php

namespace Raketa\BackendTestTask\Application\Contracts;

interface CacheConnectorInterface
{
    public function get(string $key);

    public function set(string $key, SerializableInstance $value);

    public function has($key): bool;
}