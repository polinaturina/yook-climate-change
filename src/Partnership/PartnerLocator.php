<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Exception\UnsupportedCategoryIdentifierException;
use Yook\YookCodeChallenge\Partnership\Value\Category\AvoidedEmissionCategory;
use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\CarbonRemovalWithShortLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\Category;
use Yook\YookCodeChallenge\Partnership\Value\Category\EmissionProductionWithShortLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Category\EmissionReductionWithLongLivedStorage;
use Yook\YookCodeChallenge\Partnership\Value\Country;
use Yook\YookCodeChallenge\Partnership\Value\Description;
use Yook\YookCodeChallenge\Partnership\Value\Identifier;
use Yook\YookCodeChallenge\Partnership\Value\Name;
use Yook\YookCodeChallenge\Partnership\Value\Partner;
use Yook\YookCodeChallenge\Partnership\Value\Price;

class PartnerLocator
{
    private const AVOIDED_EMISSION = 1;
    private const EMISSION_REDUCTION_WITH_SHORT_LIVED_STORAGE = 2;
    private const EMISSION_REDUCTION_WITH_LONG_LIVED_STORAGE = 3;
    private const CARBON_REMOVAL_WITH_SHORT_LIVED_STORAGE = 4;
    private const CARBON_REMOVAL_WITH_LONG_LIVED_STORAGE = 5;
    private const CATEGORY_KEY = 'category';
    private const NAME_KEY = 'name';
    private const COUNTRY_KEY = 'country';
    private const DESCRIPTION_KEY = 'description';
    private const PRICE_KEY = 'pricePerTonCO2eq';
    private const VALUE_PRICE_KEY = 'value';
    private const CURRENCY_PRICE_KEY = 'currency';
    private const IDENTIFIER_KEY = 'id';

    public function locate(array $item): Partner
    {
        switch ($this->getCategoryIdentifier($item)) {
            case self::AVOIDED_EMISSION:
                return $this->getPartner($item, new AvoidedEmissionCategory());
            case self::EMISSION_REDUCTION_WITH_SHORT_LIVED_STORAGE:
                return $this->getPartner($item, new EmissionProductionWithShortLivedStorage());
            case self::EMISSION_REDUCTION_WITH_LONG_LIVED_STORAGE:
                return $this->getPartner($item, new EmissionReductionWithLongLivedStorage());
            case self::CARBON_REMOVAL_WITH_SHORT_LIVED_STORAGE:
                return $this->getPartner($item, new CarbonRemovalWithShortLivedStorage());
            case self::CARBON_REMOVAL_WITH_LONG_LIVED_STORAGE:
                return $this->getPartner($item, new CarbonRemovalWithLongLivedStorage());
            default:
                throw new UnsupportedCategoryIdentifierException(sprintf('Category identifier %c is not supported', $this->getCategoryIdentifier($item)));
        }
    }

    private function getCategoryIdentifier(array $item): int
    {
        return (int)$item[self::CATEGORY_KEY];
    }

    private function getPartner(array $item, Category $category): Partner
    {
        return new Partner(
            new Identifier($item[self::IDENTIFIER_KEY]),
            new Name($item[self::NAME_KEY]),
            new Country($item[self::COUNTRY_KEY]),
            $category,
            new Description($item[self::DESCRIPTION_KEY]),
            new Price(
                (int)$item[self::PRICE_KEY][self::VALUE_PRICE_KEY],
                $item[self::PRICE_KEY][self::CURRENCY_PRICE_KEY]
            )
        );
    }
}
