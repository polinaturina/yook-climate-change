<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value\Category;

abstract class Category
{
    abstract public function getIdentifier(): int;

    public function isNull(): bool
    {
        return $this->getIdentifier() === 0;
    }
}
