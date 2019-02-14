<?php

namespace Metinet\Domain\Conferences;

class Price
{
    private $amount;
    private $currency;
    private $subunitMultiplicator;

    /**
     * Create a price using the lowest subunit in the given currency
     * For example, to set a price of 10 EUR, you must provide an amount of 1000
     */
    public static function inLowestSubunit(int $amount, string $currency, int $subunitMultiplicator = 1): self
    {
        return new self($amount, $currency, $subunitMultiplicator);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    private function __construct(int $amount, string $currency, int $subunitMultiplicator)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->subunitMultiplicator = $subunitMultiplicator;
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->amount / $this->subunitMultiplicator, $this->currency);
    }
}
