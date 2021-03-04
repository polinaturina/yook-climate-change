<?php

use Yook\YookCodeChallenge\Factory;
use Yook\YookCodeChallenge\Value\OffsettingAmountEuro;
use Yook\YookCodeChallenge\Value\Year;

require __DIR__ . '/../vendor/autoload.php';

$year = new Year(new DateTime('2021'));
$offsettingEur = new OffsettingAmountEuro(5000);

$factory = new Factory();

$userInput = $factory->createUserInput($year, $offsettingEur);
$app = $factory->createCarbonOffsettingApplication($userInput);
$app->run();