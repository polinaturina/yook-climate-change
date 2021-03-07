<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\CarbonOffsettingEngine;

class Mapper
{
    public function __construct()
    {
    }

    public function map(array $a, Category $category)
    {
        return new Partner(
            $category,
            new Price($a['pricePerTonCO2eq']['value'])
        );
    }
}
