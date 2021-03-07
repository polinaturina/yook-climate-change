<?php

namespace Yook\YookCodeChallenge\Partnership\Value;

use Yook\YookCodeChallenge\Partnership\Value\Category\Category;

interface Partner
{
    public function getIdentifier(): Identifier;

    public function getName(): Name;

    public function getCountry(): Country;

    public function getCategory(): Category;

    public function getDescription(): Description;

    public function getPrice(): Price;
}
