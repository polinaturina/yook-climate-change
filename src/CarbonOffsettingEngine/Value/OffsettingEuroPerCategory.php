<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\CarbonOffsettingEngine\Value;

class OffsettingEuroPerCategory
{
    private float $offsettingEuro;

    public function __construct(float $offsettingEuro)
    {
        $this->offsettingEuro = $offsettingEuro;
    }

    public function getOffsettingEuro(): float
    {
        return $this->offsettingEuro;
    }
}
