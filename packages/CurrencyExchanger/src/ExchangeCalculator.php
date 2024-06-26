<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class ExchangeCalculator implements ExchangeCalculatorInterface
{
    public function __construct(private ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
    }

    public function calculate(Money $money, Currency $toCurrency): Money
    {
        $exchangeRate = $this->exchangeRateRepository->getCurrentExchangeRate($money->currency, $toCurrency);

        return $money->multiply($exchangeRate->value)->toCurrency($toCurrency);
    }
}
