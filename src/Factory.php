<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge;

use GuzzleHttp\Client;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\CategoryOffsettingResolver;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\OffsettingAmountEuro;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\UserInput;
use Yook\YookCodeChallenge\CarbonOffsettingEngine\Value\Year;
use Yook\YookCodeChallenge\Partnership\PartnerCollectionMinimumPriceBuilder;
use Yook\YookCodeChallenge\Partnership\PartnerLocator;
use Yook\YookCodeChallenge\Partnership\PartnerSelectorClient;
use Yook\YookCodeChallenge\Partnership\PartnerCollectionBuilder;
use Yook\YookCodeChallenge\Partnership\PartnershipPayloadMapper;
use Yook\YookCodeChallenge\Partnership\Factory as PartnershipFactory;

class Factory
{
    public function createUserInput(Year $year, OffsettingAmountEuro $offsettingAmountEuro): UserInput
    {
        return new UserInput($year, $offsettingAmountEuro);
    }

    public function createCarbonOffsettingApplication(UserInput $userInput): CarbonOffsettingApplication
    {
        return new CarbonOffsettingApplication(
            $this->createCarbonOffsettingProcessor($userInput),
            $this->createPartnershipOffsettingProcessor()
        );
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

    private function createPartnershipOffsettingProcessor(): PartnershipOffsettingProcessor
    {
        return new PartnershipOffsettingProcessor(
            $this->createPartnerSelectorClient(),
            $this->createPartnerCollectionBuilder(),
            $this->createPartnershipFactory(),
            $this->createPartnerCollectionMinimumPriceBuilder()
        );
    }

    private function createPartnershipFactory(): PartnershipFactory
    {
        return new PartnershipFactory();
    }

    private function createPartnerCollectionMinimumPriceBuilder(): PartnerCollectionMinimumPriceBuilder
    {
        return new PartnerCollectionMinimumPriceBuilder();
    }
}
