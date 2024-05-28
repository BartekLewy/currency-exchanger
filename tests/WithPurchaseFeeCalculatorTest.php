<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\WithPurchaseFeeCalculator;
use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeCalculator;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\InMemoryExchangeRateRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(WithPurchaseFeeCalculator::class)]
class WithPurchaseFeeCalculatorTest extends TestCase
{
    #[Test]
    #[DataProvider('exchangeResultsDataProvider')]
    public function itCalculatesBasedOnExchangeRateAndAddsAFee(
        Money $expected,
        Money $money,
        Currency $toCurrency
    ): void {
        $exchangeMoney = new WithPurchaseFeeCalculator(new ExchangeCalculator(new InMemoryExchangeRateRepository()));

        $actual = $exchangeMoney->calculate($money, $toCurrency);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, array<int, Money|Currency>>
     */
    public static function exchangeResultsDataProvider(): iterable
    {
        yield 'EUR -> GBP' => [
            new Money(15835, Currency::GBP),
            new Money(10000, Currency::EUR),
            Currency::GBP,
        ];

        yield 'GBP -> EUR' => [
            new Money(15586, Currency::EUR),
            new Money(10000, Currency::GBP),
            Currency::EUR,
        ];
    }
}
