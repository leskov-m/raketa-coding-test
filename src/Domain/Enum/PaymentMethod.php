<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Enum;

enum PaymentMethod: string
{
    case CARD = 'card';
    case QR = 'qr';
}
