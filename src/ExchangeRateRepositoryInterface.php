<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

interface ExchangeRateRepositoryInterface
{
    /**
     * @throws ExchangeRateNotFoundException
     */
    public function getCurrentExchangeRate(Currency $from, Currency $to): ExchangeRate;
}
