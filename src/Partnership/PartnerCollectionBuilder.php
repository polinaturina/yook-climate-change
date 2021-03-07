<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;
use Yook\YookCodeChallenge\Partnership\Value\PartnershipPayload;

class PartnerCollectionBuilder
{
    private PartnerLocator $partnerLocator;

    public function __construct(PartnerLocator $partnerLocator)
    {
        $this->partnerLocator = $partnerLocator;
    }

    public function build(PartnershipPayload $payload): PartnerCollection
    {
        $partnerCollection = new PartnerCollection();
        foreach ($payload->asArray() as $item) {
            $partner = $this->partnerLocator->locate($item);
            $partnerCollection->addPartner($partner);
        }

        return $partnerCollection;
    }
}
