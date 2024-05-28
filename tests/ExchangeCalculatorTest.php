<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeCalculator;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\ObjectMothers\MoneyObjectMother;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\InMemoryExchangeRateRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ExchangeCalculator::class)]
class ExchangeCalculatorTest extends TestCase
{
    #[Test]
    #[DataProvider('exchangeResultsDataProvider')]
    public function itCalculatesBasedOnExchangeRate(Money $expected, Money $money, Currency $toCurrency): void
    {
        $exchangeMoney = new ExchangeCalculator(new InMemoryExchangeRateRepository());

        $actual = $exchangeMoney->calculate($money, $toCurrency);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, array<int, Money|Currency>>
     */
    public static function exchangeResultsDataProvider(): iterable
    {
        yield 'EUR -> GBP' => [
            MoneyObjectMother::expectedPoundsAfterExchangeFromEuro(),
            MoneyObjectMother::aHundredEuro(),
            Currency::GBP,
        ];

        yield 'GBP -> EUR' => [
            MoneyObjectMother::expectedEuroAfterExchangeFromPounds(),
            MoneyObjectMother::aHundredPounds(),
            Currency::EUR,
        ];
    }
}
