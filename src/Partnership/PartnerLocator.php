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
use Yook\YookCodeChallenge\Partnership\Value\RegularPartner;
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

    public function locate(array $item): RegularPartner
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

    private function getPartner(array $item, Category $category): RegularPartner
    {
        return new RegularPartner(
            $this->getIdentifier($item),
            $this->getName($item),
            $this->getCountry($item),
            $category,
            $this->getDescription($item),
            $this->getPrice($item)
        );
    }

    private function getIdentifier(array $item): Identifier
    {
        return new Identifier((int)$item[self::IDENTIFIER_KEY]);
    }

    private function getName(array $item): Name
    {
        return new Name((string)$item[self::NAME_KEY]);
    }

    private function getCountry(array $item): Country
    {
        return new Country((string)$item[self::COUNTRY_KEY]);
    }

    private function getDescription(array $item): Description
    {
        return new Description((string)$item[self::DESCRIPTION_KEY]);
    }

    private function getPrice(array $item): Price
    {
        return new Price(
            (int)$item[self::PRICE_KEY][self::VALUE_PRICE_KEY],
            (string)$item[self::PRICE_KEY][self::CURRENCY_PRICE_KEY]
        );
    }
}
