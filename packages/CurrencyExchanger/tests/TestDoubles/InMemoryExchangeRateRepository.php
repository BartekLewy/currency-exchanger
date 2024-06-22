<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests\TestDoubles;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\ExchangeRate;
use Bartosz\CurrencyExchanger\ExchangeRateNotFoundException;
use Bartosz\CurrencyExchanger\ExchangeRateRepositoryInterface;

final readonly class InMemoryExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    private const EXCHANGE_RATE_MAP = [
        Currency::GBP->value => [
            Currency::GBP->value => 0,
            Currency::EUR->value => 1.5432
        ],
        Currency::EUR->value => [
            Currency::EUR->value => 0,
            Currency::GBP->value => 1.5678,
        ]
    ];

    /**
     * @inheritDoc
     */
    public function getCurrentExchangeRate(Currency $from, Currency $to): ExchangeRate
    {
        if (!array_key_exists($from->value, self::EXCHANGE_RATE_MAP)) {
            throw ExchangeRateNotFoundException::forCurrency($from);
        }

        if (!array_key_exists($to->value, self::EXCHANGE_RATE_MAP[$from->value])) {
            throw ExchangeRateNotFoundException::noExchangeRateFoundBetweenCurrencies($from, $to);
        }

        return new ExchangeRate(self::EXCHANGE_RATE_MAP[$from->value][$to->value]);
    }
}
