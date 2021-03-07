<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Value;

class OffsettingAmountEuro
{
    private float $euro;

    public function __construct(float $euro)
    {
        $this->euro = $euro;
    }

    public function asDecimal(): float
    {
        return $this->euro;
    }
}
