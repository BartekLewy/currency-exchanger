<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Tests\ObjectMothers\MoneyObjectMother;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\FakeExchangeCalculator;
use Bartosz\CurrencyExchanger\WithSalesFeeCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class WithSalesFeeCalculatorTest extends TestCase
{
    #[Test]
    public function itCalculatesBasedOnExchangeRateAndChargesAFee(): void
    {
        $exchangeMoney = new WithSalesFeeCalculator(new FakeExchangeCalculator());

        $actual = $exchangeMoney->calculate(MoneyObjectMother::aHundredEuro(), Currency::GBP);

        self::assertTrue(MoneyObjectMother::GBP(9900)->equals($actual));
    }
}
