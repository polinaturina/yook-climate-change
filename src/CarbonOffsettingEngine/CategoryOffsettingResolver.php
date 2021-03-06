<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\CarbonOffsettingEngine;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingEuroPerCategory;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingEuroPerCategoryCollection;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\UserInput;

class CategoryOffsettingResolver
{
    private const TWO_DECIMALS_DIGIT = 2;
    private const BASE_YEAR = 2020;

    private UserInput $userInput;

    public function __construct(UserInput $userInput)
    {
        $this->userInput = $userInput;
    }

    public function calculate(): OffsettingEuroPerCategoryCollection
    {
        $collection = new OffsettingEuroPerCategoryCollection();

        $collection->addOffsettingEuroPerCategory(1, $this->calculateEuro($this->getCategoryOneAndTwoPercent()));
        $collection->addOffsettingEuroPerCategory(2, $this->calculateEuro($this->getCategoryOneAndTwoPercent()));
        $collection->addOffsettingEuroPerCategory(3, $this->calculateEuro($this->getCategoryThreePercent()));
        $collection->addOffsettingEuroPerCategory(4, $this->calculateEuro($this->getCategoryFourPercent()));
        $collection->addOffsettingEuroPerCategory(5, $this->calculateEuro($this->getCategoryFivePercent()));

        return $collection;
    }

    public function getCategoryOneAndTwoPercent(): float
    {
        return  $this->getShortLivedPercent() * ($this->getCategory4YAxis()/100);
    }

    private function getCategoryFourPercent(): float
    {
        return $this->getShortLivedPercent() - $this->getCategoryOneAndTwoPercent();
    }

    private function getCategory4YAxis(): float
    {
        $category4XAxis = $this->getXAxis();

        return sqrt((50 ** 2) *(1-(($category4XAxis / 30) ** 2)));
    }

    private function getCategoryThreePercent(): float
    {
        $category3XAxis = abs($this->getXAxis() - 15);
        $category3YAxis = 50 * sqrt(1 - (($category3XAxis / 15) ** 2));

        return ($category3YAxis/100) * $this->getLongLivedPercent();
    }

    private function getCategoryFivePercent(): float
    {
        return $this->getLongLivedPercent() - $this->getCategoryThreePercent();
    }

    private function getShortLivedPercent(): float
    {
        return 100 - $this->getLongLivedPercent();
    }

    private function getLongLivedPercent(): float
    {
        return $this->getLongShortSlope() * $this->getXAxis();
    }

    private function getXAxis(): int
    {
        return $this->userInput->getYear()->asInteger() - self::BASE_YEAR;
    }

    private function getLongShortSlope(): float
    {
        return 10 / 3;
    }

    public function calculateEuro(float $percent): OffsettingEuroPerCategory
    {
        return new OffsettingEuroPerCategory(
            round($this->userInput->getOffsettingAmountEuro()->asDecimal() * $percent / 100, self::TWO_DECIMALS_DIGIT)
        );
    }
}
