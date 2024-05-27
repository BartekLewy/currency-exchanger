<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

class ExchangeRateNotFoundException extends \DomainException
{
    public static function forCurrency(Currency $currency): self
    {
        return new self(sprintf('No exchange rates found for currency: %s', $currency->value));
    }

    public static function noExchangeRateFoundBetweenCurrencies(Currency $from, Currency $to): self
    {
        return new self(sprintf('No exchange rate found between %s and %s', $from->value, $to->value));
    }
}
