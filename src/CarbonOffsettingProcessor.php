<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\PartnerSelectorClient;

class CarbonOffsettingProcessor
{
    private CategoryOffsettingResolver $categoryOffsettingResolver;
    private PartnerSelectorClient $partnerSelectorClient;

    public function __construct(CategoryOffsettingResolver $categoryOffsettingResolver)
    {
        $this->categoryOffsettingResolver = $categoryOffsettingResolver;
    }

    public function process(): void
    {
        $offsettingEuro = $this->categoryOffsettingResolver->calculate();

        $this->partnerSelectorClient->selectPartner($offsettingEuro);
    }
}
