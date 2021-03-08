<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\Category\AvoidedEmissionCategory;
use Yook\YookCodeChallenge\Partnership\Value\Category\Category;
use Yook\YookCodeChallenge\Partnership\Value\Category\EmissionProductionWithShortLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Partner;
use Yook\YookCodeChallenge\Partnership\Value\RegularPartner;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;

class PartnershipProcessor
{
    private PartnerCollection $partnerCollection;

    public function __construct(PartnerCollection $partnerCollection)
    {
        $this->partnerCollection = $partnerCollection;
    }

    public function getPartnerWithMinimumOffsettingPriceByCategory(Category $category): Partner
    {
        $partnerCollection = $this->partnerCollection->findMatchingPartners($category);

        if ($partnerCollection->isEmpty()) {
            return new NullPartner();
        }

        if ($partnerCollection->count() === 1) {
            return $partnerCollection->getFirst();
        }

        $key = $partnerCollection->getFirst()->getIdentifier()->asInt();
        $partnerWithMinimumOffsettingPrice = $partnerCollection->getFirst()->getPrice()->getValue();

        /** @var RegularPartner $partner */
        foreach ($partnerCollection as $partner) {
            $currentOffsettingPrice = $partner->getPrice()->getValue();

            if ($currentOffsettingPrice < $partnerWithMinimumOffsettingPrice) {
                $partnerWithMinimumOffsettingPrice = $currentOffsettingPrice;
                $key = $partner->getIdentifier()->asInt();
            }
        }

        return $partnerCollection->getElement($key);
    }

    public function getPartnerWithMinimumOffsettingPriceBetweenFirstAndSecondCategory(): Partner
    {
        $partnersFromCategoryOne = $this->getPartnerWithMinimumOffsettingPriceByCategory(new AvoidedEmissionCategory());
        $partnersFromCategoryTwo = $this->getPartnerWithMinimumOffsettingPriceByCategory(new EmissionProductionWithShortLivedStorage());

        if ($partnersFromCategoryOne->getPrice()->getValue() < $partnersFromCategoryTwo->getPrice()->getValue()) {
            return $partnersFromCategoryOne;
        }

        return $partnersFromCategoryTwo;
    }
}
