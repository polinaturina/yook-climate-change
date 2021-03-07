<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\Category\Category;
use Yook\YookCodeChallenge\Partnership\Value\Category\NullCategory;
use Yook\YookCodeChallenge\Partnership\Value\Country;
use Yook\YookCodeChallenge\Partnership\Value\Description;
use Yook\YookCodeChallenge\Partnership\Value\Identifier;
use Yook\YookCodeChallenge\Partnership\Value\Name;
use Yook\YookCodeChallenge\Partnership\Value\Partner;
use Yook\YookCodeChallenge\Partnership\Value\Price;

class NullPartner implements Partner
{
    public function getIdentifier(): Identifier
    {
        return new Identifier(0);
    }

    public function getName(): Name
    {
        return new Name('no name');
    }

    public function getCountry(): Country
    {
        return new Country('no county');
    }

    public function getCategory(): Category
    {
        return new NullCategory();
    }

    public function getDescription(): Description
    {
        return new Description('no description');
    }

    public function getPrice(): Price
    {
        return new Price(
            0,
            'no currency'
        );
    }
}
