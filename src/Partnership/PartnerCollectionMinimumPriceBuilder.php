<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithShortLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\EmissionReductionWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;

class PartnerCollectionMinimumPriceBuilder
{
    public function build(PartnershipProcessor $partnershipProcessor): PartnerCollection
    {
        $collection = new PartnerCollection();

        $collection->addPartner($partnershipProcessor->getPartnerWithMinimumOffsettingPriceBetweenFirstAndSecondCategory());
        $collection->addPartner($partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new EmissionReductionWithLongLivedStorage()));
        $collection->addPartner($partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new CarbonRemovalWithShortLivedStorage()));
        $collection->addPartner($partnershipProcessor->getPartnerWithMinimumOffsettingPriceByCategory(new CarbonRemovalWithLongLivedStorage()));

        return $collection;
    }
}
