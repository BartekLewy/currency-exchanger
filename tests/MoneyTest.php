<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Money::class)]
class MoneyTest extends TestCase
{
    #[Test]
    public function isTheSameCurrency(): void
    {
        $first = new Money(10000, Currency::EUR);
        $second = new Money(20000, Currency::EUR);

        self::assertTrue($first->isTheSameCurrency($second));
    }

    #[Test]
    public function isNotTheSameCurrency(): void
    {
        $first = new Money(10000, Currency::EUR);
        $second = new Money(20000, Currency::GBP);

        self::assertFalse($first->isTheSameCurrency($second));
    }

    #[Test]
    #[DataProvider('moneyDataProvider')]
    public function addMoney(Money $expected, Money $first, Money $second): void
    {
        $actual = $first->add($second);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, Money[]>
     */
    public static function moneyDataProvider(): iterable
    {
        yield 'EUR' => [
            new Money(20000, Currency::EUR),
            new Money(10000, Currency::EUR),
            new Money(10000, Currency::EUR),
        ];
        yield 'GBP' => [
            new Money(20000, Currency::GBP),
            new Money(10000, Currency::GBP),
            new Money(10000, Currency::GBP),
        ];
    }

    #[Test]
    public function throwInvalidArgumentExceptionWhenCurrencyIsNotTheSame(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Currencies must be the same');

        $first = new Money(10000, Currency::EUR);
        $second = new Money(10000, Currency::GBP);

        $first->add($second);
    }
}