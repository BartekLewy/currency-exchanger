<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class WithPurchaseFeeCalculator implements ExchangeCalculatorInterface
{
    private const TRANSACTION_FEE = 0.01;

    public function __construct(private ExchangeCalculatorInterface $exchangeMoney)
    {
    }

    public function calculate(Money $money, Currency $toCurrency): Money
    {
        $money = $this->exchangeMoney->calculate($money, $toCurrency);

        return $money->add($money->multiply(self::TRANSACTION_FEE));
    }
}
