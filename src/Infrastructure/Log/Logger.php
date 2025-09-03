<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Log;

use Raketa\BackendTestTask\Application\Contracts\ExtendedLoggerInterface;

/**
 * заглушка
 */
class Logger implements ExtendedLoggerInterface
{

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement error() method.
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement info() method.
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }

    public function logThrowable(\Throwable $throwable): void
    {
        $this->error($throwable->getMessage(), [
            'line' => $throwable->getLine(),
            'file' => $throwable->getFile(),
            'trace' => $throwable->getTrace(),
        ]);
    }
}