<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

interface ExchangeCalculatorInterface
{
    public function calculate(Money $money, Currency $toCurrency): Money;
}
