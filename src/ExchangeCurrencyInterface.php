<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

interface ExchangeCurrencyInterface
{
    public function exchange(Money $money, Currency $toCurrency): Money;
}
