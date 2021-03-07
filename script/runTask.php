<?php

use Yook\YookCodeChallenge\Factory;
use Yook\YookCodeChallenge\Partnership\Value\Category\AvoidedEmissionCategory;
use Yook\YookCodeChallenge\Value\OffsettingAmountEuro;
use Yook\YookCodeChallenge\Value\Year;

require __DIR__ . '/../vendor/autoload.php';

$year = new Year(new DateTime('2021'));
$offsettingEur = new OffsettingAmountEuro(5000);

$factory = new Factory();

$partnershipSelectorClient = $factory->createPartnerSelectorClient();
$builder = $factory->createPartnerCollectionBuilder();
$collection = $builder->build($partnershipSelectorClient->getPartnershipPayload());

var_dump($collection->findMatchingPartners(new AvoidedEmissionCategory()));

die();
$userInput = $factory->createUserInput($year, $offsettingEur);
$app = $factory->createCarbonOffsettingApplication($userInput);
$app->run();