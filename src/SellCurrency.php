<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class SellCurrency implements ExchangeCurrencyInterface
{
    private const TRANSACTION_FEE = 0.01;

    public function __construct(private ExchangeCurrencyInterface $exchangeMoney)
    {
    }

    public function exchange(Money $money, Currency $toCurrency): Money
    {
        $money = $this->exchangeMoney->exchange($money, $toCurrency);

        return $money->subtract($money->multiply(self::TRANSACTION_FEE));
    }
}
