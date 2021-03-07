<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use GuzzleHttp\Client;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;
use Yook\YookCodeChallenge\Partnership\PartnerCollectionWithMinimumOffsettingPriceByCategoryBuilder;
use Yook\YookCodeChallenge\Partnership\PartnerLocator;
use Yook\YookCodeChallenge\Partnership\PartnerSelectorClient;
use Yook\YookCodeChallenge\Partnership\PartnerCollectionBuilder;
use Yook\YookCodeChallenge\Partnership\PartnershipPayloadMapper;
use Yook\YookCodeChallenge\Partnership\PartnershipProcessor;
use Yook\YookCodeChallenge\Partnership\Value\PartnerCollection;
use Yook\YookCodeChallenge\Value\OffsettingAmountEuro;
use Yook\YookCodeChallenge\Value\UserInput;
use Yook\YookCodeChallenge\Value\Year;

class Factory
{
    public function createUserInput(Year $year, OffsettingAmountEuro $offsettingAmountEuro): UserInput
    {
        return new UserInput($year, $offsettingAmountEuro);
    }

    public function createCarbonOffsettingApplication(UserInput $userInput): CarbonOffsettingApplication
    {
        return new CarbonOffsettingApplication($this->createCarbonOffsettingProcessor($userInput));
    }

    private function createCarbonOffsettingProcessor(UserInput $userInput): CarbonOffsettingProcessor
    {
        return new CarbonOffsettingProcessor($this->createCategoryOffsettingResolver($userInput));
    }

    private function createCategoryOffsettingResolver(UserInput $userInput): CategoryOffsettingResolver
    {
        return new CategoryOffsettingResolver($userInput);
    }

    public function createPartnerSelectorClient(): PartnerSelectorClient
    {
        return new PartnerSelectorClient(
            $this->createHttpClient(),
            $this->createPartnershipPayloadMapper()
        );
    }

    private function createHttpClient(): Client
    {
        return new Client();
    }

    private function createPartnershipPayloadMapper(): PartnershipPayloadMapper
    {
        return new PartnershipPayloadMapper();
    }

    public function createPartnerCollectionBuilder(): PartnerCollectionBuilder
    {
        return new PartnerCollectionBuilder(
            $this->createPartnerLocator()
        );
    }

    private function createPartnerLocator(): PartnerLocator
    {
        return new PartnerLocator();
    }

    public function createPartnershipProcessor(PartnerCollection $collection): PartnershipProcessor
    {
        return new PartnershipProcessor($collection);
    }

    public function createPartnerCollectionWithMinimumOffsettingPriceByCategoryBuilder(PartnerCollection $collection): PartnerCollectionWithMinimumOffsettingPriceByCategoryBuilder
    {
        return new PartnerCollectionWithMinimumOffsettingPriceByCategoryBuilder($this->createPartnershipProcessor($collection));
    }
}
