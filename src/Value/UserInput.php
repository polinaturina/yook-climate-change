<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Value;

class UserInput
{
    private Year $year;
    private OffsettingAmountEuro $offsettingAmountEuro;

    public function __construct(Year $year, OffsettingAmountEuro $offsettingAmountEuro)
    {
        $this->year = $year;
        $this->offsettingAmountEuro = $offsettingAmountEuro;
    }

    public function getYear(): Year
    {
        return $this->year;
    }

    public function getOffsettingAmountEuro(): OffsettingAmountEuro
    {
        return $this->offsettingAmountEuro;
    }
}