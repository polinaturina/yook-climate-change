<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\Partnership\PartnerCollectionBuilder;
use Yook\YookCodeChallenge\Partnership\PartnerCollectionMinimumPriceBuilder;
use Yook\YookCodeChallenge\Partnership\PartnerSelectorClient;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;
use Yook\YookCodeChallenge\Partnership\Factory as PartnershipFactory;

class PartnershipOffsettingProcessor
{
    private PartnerSelectorClient $partnerSelectorClient;
    private PartnerCollectionBuilder $partnerCollectionBuilder;
    private PartnershipFactory $factory;
    private PartnerCollectionMinimumPriceBuilder $partnerCollectionMinimumPriceBuilder;

    public function __construct(
        PartnerSelectorClient $partnerSelectorClient,
        PartnerCollectionBuilder $partnerCollectionBuilder,
        PartnershipFactory $factory,
        PartnerCollectionMinimumPriceBuilder $partnerCollectionMinimumPriceBuilder
    ) {
        $this->partnerSelectorClient = $partnerSelectorClient;
        $this->partnerCollectionBuilder = $partnerCollectionBuilder;
        $this->factory = $factory;
        $this->partnerCollectionMinimumPriceBuilder = $partnerCollectionMinimumPriceBuilder;
    }

    public function process(): PartnerCollection
    {
        $partnershipPayload = $this->partnerSelectorClient->getPartnershipPayload();
        $partnerCollection = $this->partnerCollectionBuilder->build($partnershipPayload);
        $partnerShipProcessor = $this->factory->createPartnershipProcessor($partnerCollection);

        return $this->partnerCollectionMinimumPriceBuilder->build($partnerShipProcessor);
    }
}
