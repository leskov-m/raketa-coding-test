<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Application\Service;

use Exception;
use Raketa\BackendTestTask\Application\Contracts\CacheServiceInterface;
use Raketa\BackendTestTask\Application\Contracts\ExtendedLoggerInterface;
use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Enum\PaymentMethod;
use Raketa\BackendTestTask\Infrastructure\Configuration\RedisConfiguration;
use Raketa\BackendTestTask\Infrastructure\Factory\CacheConnectorFactory;
use Raketa\BackendTestTask\Infrastructure\Factory\LoggerFactory;
use Raketa\BackendTestTask\Infrastructure\Service\RedisService;

class CartService
{
    private CacheServiceInterface $cacheService;
    private ExtendedLoggerInterface $logger;

    public function __construct()
    {
        $configuration = new RedisConfiguration();
        $connector = CacheConnectorFactory::create();

        $this->logger = LoggerFactory::create();
        $this->cacheService = new RedisService($connector, $configuration);
    }

    public function saveCart(Cart $cart): void
    {
        try {
            $this->cacheService->getConnector()->set(session_id(), $cart);
        } catch (Exception $e) {
            $this->logger->logThrowable($e);
        }
    }

    public function getCart(): Cart
    {
        try {
            return $this->cacheService->getConnector()->get(session_id());
        } catch (Exception $e) {
            $this->logger->logThrowable($e);
        }

        return new Cart(
            uuid: session_id(),
            paymentMethod: PaymentMethod::CARD->value,
            items: [],
            customer: null,
        );
    }
}
