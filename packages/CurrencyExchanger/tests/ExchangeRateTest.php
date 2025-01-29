<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\ExchangeRate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase
{
    #[Test]
    #[DataProvider('exchangeRateValueProvider')]
    public function itThrowsExceptionWhenExchangeRateIsLowerThanZero(int $value): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('An exchange rate must be higher than zero');

        new ExchangeRate($value);
    }

    /**
     * @return iterable<string, int[]>
     */
    public static function exchangeRateValueProvider(): iterable
    {
        yield 'ZERO' => [0];
        yield 'MINUS ONE' => [-1];
        yield 'MINUS HUNDRED' => [-100];
    }
}
