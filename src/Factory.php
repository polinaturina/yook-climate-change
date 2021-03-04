<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;
use Yook\YookCodeChallenge\Value\OffsettingAmountEuro;
use Yook\YookCodeChallenge\Value\UserInput;
use Yook\YookCodeChallenge\Value\Year;

class Factory
{
    public function createUserInput(Year $year, OffsettingAmountEuro $offsettingAmountEuro): UserInput
    {
        return new UserInput($year, $offsettingAmountEuro);
    }

    public function createCarbonOffsettingApplication(UserInput $userInput): CarbonOffsettingApplication
    {
        return new CarbonOffsettingApplication($this->createCarbonOffsettingProcessor($userInput));
    }

    private function createCarbonOffsettingProcessor(UserInput $userInput): CarbonOffsettingProcessor
    {
        return new CarbonOffsettingProcessor($this->createCategoryOffsettingResolver($userInput));
    }

    private function createCategoryOffsettingResolver(UserInput $userInput): CategoryOffsettingResolver
    {
        return new CategoryOffsettingResolver($userInput);
    }
}