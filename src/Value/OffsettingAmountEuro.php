<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Value;

use JetBrains\PhpStorm\Pure;

class OffsettingAmountEuro
{
    private float $euro;

    public function __construct(float $euro)
    {
        $this->euro = $euro;
    }

    #[Pure]
    public function asFloat(): float
    {
        return $this->euro;
    }
}