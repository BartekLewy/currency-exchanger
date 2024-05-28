<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class Money
{
    public int $value;
    public Currency $currency;

    public function __construct(
        int $value,
        Currency $currency
    ) {
        $this->value = $value;
        $this->currency = $currency;
    }


    public function add(Money $other): Money
    {
        if (!$this->isTheSameCurrency($other)) {
            throw new \InvalidArgumentException('Currencies must be the same');
        }

        return new Money($this->value + $other->value, $this->currency);
    }

    public function subtract(Money $other): Money
    {
        if (!$this->isTheSameCurrency($other)) {
            throw new \InvalidArgumentException('Currencies must be the same');
        }

        return new Money($this->value - $other->value, $this->currency);
    }

    public function multiply(int|float $multiplier): Money
    {
        return new Money((int)(round($this->value * $multiplier, mode: PHP_ROUND_HALF_EVEN)), $this->currency);
    }

    public function isTheSameCurrency(Money $other): bool
    {
        return $this->currency === $other->currency;
    }

    public function equals(Money $other): bool
    {
        return $this->value === $other->value
            && $this->currency === $other->currency;
    }

    public function toCurrency(Currency $currency): Money
    {
        return new Money($this->value, $currency);
    }
}
