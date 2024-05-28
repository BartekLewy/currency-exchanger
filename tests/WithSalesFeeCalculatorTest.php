<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\FakeExchangeCalculator;
use Bartosz\CurrencyExchanger\WithSalesFeeCalculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(WithSalesFeeCalculator::class)]
class WithSalesFeeCalculatorTest extends TestCase
{
    #[Test]
    public function itCalculatesBasedOnExchangeRateAndChargesAFee(): void
    {
        $exchangeMoney = new WithSalesFeeCalculator(new FakeExchangeCalculator());

        $actual = $exchangeMoney->calculate(new Money(10000, Currency::EUR), Currency::GBP);

        $expected = new Money(9900, Currency::GBP);

        self::assertTrue($expected->equals($actual));
    }

}
