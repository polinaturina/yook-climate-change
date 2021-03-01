<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

class Factory
{
    public function createCarbonOffsettingEngine(): CarbonOffsettingApplication
    {
        return new CarbonOffsettingApplication();
    }
}