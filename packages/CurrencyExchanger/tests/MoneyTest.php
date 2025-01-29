<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\ObjectMothers\MoneyObjectMother;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
    #[DataProvider('addMoneyDataProvider')]
    public function addMoney(Money $expected, Money $first, Money $second): void
    {
        $actual = $first->add($second);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, Money[]>
     */
    public static function addMoneyDataProvider(): iterable
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
    #[DataProvider('subtractMoneyDataProvider')]
    public function subtractMoney(Money $expected, Money $first, Money $second): void
    {
        $actual = $first->subtract($second);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, Money[]>
     */
    public static function subtractMoneyDataProvider(): iterable
    {
        yield 'EUR' => [
            new Money(20000, Currency::EUR),
            new Money(30000, Currency::EUR),
            new Money(10000, Currency::EUR),
        ];
        yield 'GBP' => [
            new Money(20000, Currency::GBP),
            new Money(30000, Currency::GBP),
            new Money(10000, Currency::GBP),
        ];
    }

    #[Test]
    public function throwInvalidArgumentExceptionDuringAddingWhenCurrencyIsNotTheSame(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Currencies must be the same');

        $first = new Money(10000, Currency::EUR);
        $second = new Money(10000, Currency::GBP);

        $first->add($second);
    }

    #[Test]
    public function throwInvalidArgumentExceptionDuringSubtractWhenCurrencyIsNotTheSame(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Currencies must be the same');

        $first = new Money(10000, Currency::EUR);
        $second = new Money(10000, Currency::GBP);

        $first->subtract($second);
    }

    #[Test]
    public function givenMoneyAreNotEqual(): void
    {
        $eur = MoneyObjectMother::EUR(100);
        $gbp = MoneyObjectMother::GBP(100);

        $this->assertFalse($eur->equals($gbp));
    }
}
