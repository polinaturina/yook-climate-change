<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

class CarbonOffsettingApplication
{
    private CarbonOffsettingProcessor $carbonOffsettingProcessor;
    private PartnershipOffsettingProcessor $partnershipOffsettingProcessor;

    public function __construct(
        CarbonOffsettingProcessor $carbonOffsettingProcessor,
        PartnershipOffsettingProcessor $partnershipOffsettingProcessor
    ) {
        $this->carbonOffsettingProcessor = $carbonOffsettingProcessor;
        $this->partnershipOffsettingProcessor = $partnershipOffsettingProcessor;
    }

    public function run(): void
    {
        $this->carbonOffsettingProcessor->process();
        $this->partnershipOffsettingProcessor->process();
    }
}
