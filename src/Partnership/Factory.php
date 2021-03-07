<?php
declare(strict_types=1);
namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;

class Factory
{
    public function createPartnershipProcessor(PartnerCollection $collection): PartnershipProcessor
    {
        return new PartnershipProcessor($collection);
    }
}
