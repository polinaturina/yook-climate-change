<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;


use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithShortLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\EmissionReductionWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;

class PartnerCollectionWithMinimumOffsettingPriceByCategoryBuilder
{
    private PartnershipProcessor $partnershipProcessor;

    public function __construct(PartnershipProcessor $partnershipProcessor)
    {
        $this->partnershipProcessor = $partnershipProcessor;
    }

    public function build(): PartnerCollection
    {
        $collection = new PartnerCollection();

        $collection->addPartner($this->partnershipProcessor->getPartnerWithMinimumOffsettingPriceBetweenFirstAndSecondCategory());
        $collection->addPartner($this->partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new EmissionReductionWithLongLivedStorage()));
        $collection->addPartner($this->partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new CarbonRemovalWithShortLivedStorage()));
        $collection->addPartner($this->partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new CarbonRemovalWithLongLivedStorage()));

        return $collection;
    }
}