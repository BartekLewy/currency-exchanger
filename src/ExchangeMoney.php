<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class ExchangeMoney
{
    public function exchange(Money $money, Currency $toCurrency): Money
    {
        if ($toCurrency === Currency::GBP) {
            $multiplier = 1.5678;
        }

        if ($toCurrency === Currency::EUR) {
            $multiplier = 1.5432;
        }

        return $money->multiply($multiplier)->toCurrency($toCurrency);
    }
}
