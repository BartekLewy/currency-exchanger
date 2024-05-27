<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class Money
{
    private int $value;
    private Currency $currency;

    public function __construct(
        int $value,
        Currency $currency
    ) {
        $this->value = $value;
        $this->currency = $currency;
    }


    public function add(Money $second): Money
    {
        if (!$this->isTheSameCurrency($second)) {
            throw new \InvalidArgumentException('Currencies must be the same');
        }

        return new Money($this->value + $second->value, $this->currency);
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
}
