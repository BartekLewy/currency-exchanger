<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\TestDoubles\FakeExchangeCalculator;
use Bartosz\CurrencyExchanger\WithPurchaseFeeCalculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(WithPurchaseFeeCalculator::class)]
class WithPurchaseFeeCalculatorTest extends TestCase
{
    #[Test]
    public function itCalculatesBasedOnExchangeRateAndAddsAFee(): void
    {
        $exchangeMoney = new WithPurchaseFeeCalculator(new FakeExchangeCalculator());

        $actual = $exchangeMoney->calculate(new Money(10000, Currency::EUR), Currency::GBP);

        $expected = new Money(10100, Currency::GBP);

        self::assertTrue($expected->equals($actual));
    }
}
