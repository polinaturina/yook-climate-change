<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value\Category;

class NullCategory extends Category
{
    public function getIdentifier(): int
    {
        return 0;
    }
}
