<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeCurrency;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\SellCurrency;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\InMemoryExchangeRateRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(SellCurrency::class)]
class SellCurrencyTest extends TestCase
{
    #[Test]
    #[DataProvider('exchangeResultsDataProvider')]
    public function itExchangesMoneyBasedOnExchangeRateAndChargesAFee(
        Money $expected,
        Money $money,
        Currency $toCurrency
    ): void {
        $exchangeMoney = new SellCurrency(new ExchangeCurrency(new InMemoryExchangeRateRepository()));

        $actual = $exchangeMoney->exchange($money, $toCurrency);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, array<int, Money|Currency>>
     */
    public static function exchangeResultsDataProvider(): iterable
    {
        yield 'EUR -> GBP' => [
            new Money(15521, Currency::GBP),
            new Money(10000, Currency::EUR),
            Currency::GBP,
        ];

        yield 'GBP -> EUR' => [
            new Money(15278, Currency::EUR),
            new Money(10000, Currency::GBP),
            Currency::EUR,
        ];
    }
}
