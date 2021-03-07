<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;

class CarbonOffsettingProcessor
{
    private CategoryOffsettingResolver $categoryOffsettingResolver;

    public function __construct(CategoryOffsettingResolver $categoryOffsettingResolver)
    {
        $this->categoryOffsettingResolver = $categoryOffsettingResolver;
    }

    public function process(): array
    {
        return $this->categoryOffsettingResolver->calculate();
    }
}
