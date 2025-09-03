<?php

namespace Raketa\BackendTestTask\Application\Contracts;

use Psr\Log\LoggerInterface;

interface ExtendedLoggerInterface extends LoggerInterface
{
    public function logThrowable(\Throwable $throwable): void;
}