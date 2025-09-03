<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Factory;

use Raketa\BackendTestTask\Application\Contracts\ExtendedLoggerInterface;
use Raketa\BackendTestTask\Infrastructure\Log\Logger;

class LoggerFactory
{
    public static function create(): ExtendedLoggerInterface
    {
        return new Logger();
    }
}