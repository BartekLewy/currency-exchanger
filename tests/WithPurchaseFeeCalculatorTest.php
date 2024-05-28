<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;
use Bartosz\CurrencyExchanger\Tests\ObjectMothers\MoneyObjectMother;
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

        $actual = $exchangeMoney->calculate(MoneyObjectMother::aHundredEuro(), Currency::GBP);

        self::assertTrue(MoneyObjectMother::GBP(10100)->equals($actual));
    }
}
