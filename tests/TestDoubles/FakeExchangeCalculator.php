<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests\TestDoubles;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeCalculatorInterface;
use Bartosz\CurrencyExchanger\Money;

final readonly class FakeExchangeCalculator implements ExchangeCalculatorInterface
{

    public function calculate(Money $money, Currency $toCurrency): Money
    {
        return new Money($money->value, $toCurrency);
    }
}