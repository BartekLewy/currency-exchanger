<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger\Tests\ObjectMothers;

use Bartosz\CurrencyExchanger\Currency;
use Bartosz\CurrencyExchanger\Money;

final readonly class MoneyObjectMother
{
    public static function EUR(int $value): Money
    {
        return new Money($value, Currency::EUR);
    }

    public static function GBP(int $value): Money
    {
        return new Money($value, Currency::GBP);
    }

    public static function aHundredEuro(): Money
    {
        return self::EUR(10000);
    }

    public static function aHundredPounds(): Money
    {
        return self::GBP(10000);
    }

    public static function expectedPoundsAfterExchangeFromEuro(): Money
    {
        return self::GBP(15678);
    }

    public static function expectedEuroAfterExchangeFromPounds(): Money
    {
        return self::EUR(15432);
    }
}
