<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

class Country
{
    private string $country;

    public function __construct(string $country)
    {
        $this->country = $country;
    }

    public function asString(): string
    {
        return $this->country;
    }
}
