<?php

namespace Raketa\BackendTestTask\Application\Contracts;

interface ConfigurationInterface
{
    public function get(): array;
}