<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeCalculator;
use Bartosz\CurrencyExchanger\ExchangeCurrencyFacade;
use Bartosz\CurrencyExchanger\ExchangeRateNotFoundException;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\ObjectMothers\MoneyObjectMother;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\InMemoryExchangeRateRepository;
use Bartosz\CurrencyExchanger\WithPurchaseFeeCalculator;
use Bartosz\CurrencyExchanger\WithSalesFeeCalculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ExchangeCurrencyFacade::class)]
class ExchangeCurrencyFacadeTest extends TestCase
{
    private ExchangeCurrencyFacade $facade;

    protected function setUp(): void
    {
        $exchangeCalculator = new ExchangeCalculator(new InMemoryExchangeRateRepository());

        $this->facade = new ExchangeCurrencyFacade(
            new WithPurchaseFeeCalculator($exchangeCalculator),
            new WithSalesFeeCalculator($exchangeCalculator),
        );
    }

    #[Test]
    #[DataProvider('purchaseDataProvider')]
    public function purchaseCurrency(Money $expected, Money $money, Currency $currency): void
    {
        $actual = $this->facade->purchase($money, $currency);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, array<int, Money|Currency>>
     */
    public static function purchaseDataProvider(): iterable
    {
        yield 'EUR -> GBP' => [
            MoneyObjectMother::GBP(15835),
            MoneyObjectMother::aHundredEuro(),
            Currency::GBP,
        ];

        yield 'GBP -> EUR' => [
            MoneyObjectMother::EUR(15586),
            MoneyObjectMother::aHundredPounds(),
            Currency::EUR,
        ];
    }

    #[Test]
    public function throwExchangeRateNotFoundExceptionOnPurchase(): void
    {
        self::expectException(ExchangeRateNotFoundException::class);
        self::expectExceptionMessage('No exchange rate found between EUR and USD');

        $this->facade->purchase(MoneyObjectMother::aHundredEuro(), Currency::USD);
    }

    #[Test]
    #[DataProvider('sellDataProvider')]
    public function sellCurrency(Money $expected, Money $money, Currency $currency): void
    {
        $actual = $this->facade->sell($money, $currency);

        self::assertTrue($expected->equals($actual));
    }

    /**
     * @return iterable<string, array<int, Money|Currency>>
     */
    public static function sellDataProvider(): iterable
    {
        yield 'EUR -> GBP' => [
            MoneyObjectMother::GBP(15521),
            MoneyObjectMother::aHundredEuro(),
            Currency::GBP,
        ];

        yield 'GBP -> EUR' => [
            MoneyObjectMother::EUR(15278),
            MoneyObjectMother::aHundredPounds(),
            Currency::EUR,
        ];
    }

    #[Test]
    public function throwExchangeRateNotFoundExceptionOnSell(): void
    {
        self::expectException(ExchangeRateNotFoundException::class);
        self::expectExceptionMessage('No exchange rate found between EUR and USD');

        $this->facade->purchase(MoneyObjectMother::aHundredEuro(), Currency::USD);
    }
}
