<?php

declare(strict_types=1);

namespace Bartosz\CurrencyExchanger;

final readonly class ExchangeCurrencyFacade
{
    public function __construct(
        private WithPurchaseFeeCalculator $withPurchaseFeeCalculator,
        private WithSalesFeeCalculator $withSalesFeeCalculator,
    ) {
    }

    public function purchase(Money $money, Currency $currency): Money
    {
        return $this->withPurchaseFeeCalculator->calculate($money, $currency);
    }

    public function sell(Money $money, Currency $currency): Money
    {
        return $this->withSalesFeeCalculator->calculate($money, $currency);
    }
}