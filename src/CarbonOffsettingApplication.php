<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\Value\UserInput;

class CarbonOffsettingApplication
{
//    private OffsettCurrencyCalculator $currencyCalculator;
//    private PartnerSelector $partnerSelector;

    private UserInput $userInput;
    private CarbonOffsettingProcessor $carbonOffsettingProcessor;

    public function __construct(UserInput $userInput, CarbonOffsettingProcessor $carbonOffsettingProcessor)
    {
        $this->userInput = $userInput;
        $this->carbonOffsettingProcessor = $carbonOffsettingProcessor;
    }

    public function run(): void
    {
        $this->carbonOffsettingProcessor->process($this->userInput);
    }
}