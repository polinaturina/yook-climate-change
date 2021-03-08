<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingEuroPerCategory;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingEuroPerCategoryCollection;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\UserInput;
use Yook\YookCodeChallenge\Partnership\Value\Partner;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;

class UserMessage
{
    public function printMessage(
        OffsettingEuroPerCategoryCollection $offsettingEuroPerCategoryCollection,
        PartnerCollection $partnerCollection
    ): void {
        /** @var Partner $partner */
        foreach ($partnerCollection as $partner) {
            $categoryIdentifier = $partner->getCategory();

            if (!$categoryIdentifier->isNull()) {
                $offsetting = $offsettingEuroPerCategoryCollection->getElement($categoryIdentifier->getIdentifier());
                $message = sprintf(
                    'Invest %g in %s for category %d',
                    $offsetting->getOffsettingEuro(),
                    $partner->getName()->asString(),
                    $categoryIdentifier->getIdentifier()
                );

                echo $message.PHP_EOL;
            }
        }
    }
}
