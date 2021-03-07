<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

class Price
{
    private int $value;
    private string $currency;

    public function __construct(int $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
