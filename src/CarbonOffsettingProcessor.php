<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingEuroPerCategoryCollection;

class CarbonOffsettingProcessor
{
    private CategoryOffsettingResolver $categoryOffsettingResolver;

    public function __construct(CategoryOffsettingResolver $categoryOffsettingResolver)
    {
        $this->categoryOffsettingResolver = $categoryOffsettingResolver;
    }

    public function process(): OffsettingEuroPerCategoryCollection
    {
        return $this->categoryOffsettingResolver->calculate();
    }
}
