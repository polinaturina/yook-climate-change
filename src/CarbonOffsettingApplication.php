<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

class CarbonOffsettingApplication
{
    private CarbonOffsettingProcessor $carbonOffsettingProcessor;
    private PartnershipOffsettingProcessor $partnershipOffsettingProcessor;
    private UserMessage $userMessage;

    public function __construct(
        CarbonOffsettingProcessor $carbonOffsettingProcessor,
        PartnershipOffsettingProcessor $partnershipOffsettingProcessor,
        UserMessage $userMessage
    ) {
        $this->carbonOffsettingProcessor = $carbonOffsettingProcessor;
        $this->partnershipOffsettingProcessor = $partnershipOffsettingProcessor;
        $this->userMessage = $userMessage;
    }

    public function run(): void
    {
        $offsettingEuroPerCategoryCollection = $this->carbonOffsettingProcessor->process();
        $partnerCollection = $this->partnershipOffsettingProcessor->process();

        $this->userMessage->printMessage($offsettingEuroPerCategoryCollection, $partnerCollection);
    }
}
