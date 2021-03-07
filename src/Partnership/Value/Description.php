<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

class Description
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function asString(): string
    {
        return $this->description;
    }
}
