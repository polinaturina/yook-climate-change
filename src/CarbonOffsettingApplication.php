<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

class CarbonOffsettingApplication
{
    private CarbonOffsettingProcessor $carbonOffsettingProcessor;

    public function __construct(CarbonOffsettingProcessor $carbonOffsettingProcessor)
    {
        $this->carbonOffsettingProcessor = $carbonOffsettingProcessor;
    }

    public function run(): void
    {
        $this->carbonOffsettingProcessor->process();
    }
}