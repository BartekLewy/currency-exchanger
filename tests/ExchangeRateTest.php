<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\ExchangeRate;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase
{
    #[Test]
    public function itThrowsExceptionWhenExchangeRateIsLowerThanZero(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('An exchange rate must be higher than zero');

        new ExchangeRate(-1);
    }
}
