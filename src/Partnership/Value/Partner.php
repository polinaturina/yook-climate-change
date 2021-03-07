<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

use Yook\YookCodeChallenge\Partnership\Value\Category\Category;

class Partner
{
    private Identifier $identifier;
    private Name $name;
    private Country $country;
    private Category $category;
    private Description $description;
    private Price $price;

    public function __construct(
        Identifier $identifier,
        Name $name,
        Country $country,
        Category $category,
        Description $description,
        Price $price
    ) {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->country = $country;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
