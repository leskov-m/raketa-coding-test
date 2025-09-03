<?php

namespace Raketa\BackendTestTask\Application\Contracts;

interface CacheServiceInterface
{
    public function getConnector(): CacheConnectorInterface;

    public function connect(): void;
}