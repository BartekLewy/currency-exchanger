<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class ExchangeRate
{
    public int|float $value;

    public function __construct(int|float $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('An exchange rate must be higher than zero');
        }

        $this->value = $value;
    }
}
