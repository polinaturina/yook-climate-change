<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function asString(): string
    {
        return $this->name;
    }
}
