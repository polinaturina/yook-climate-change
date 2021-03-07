<?php
declare(strict_types=1);


namespace Yook\YookCodeChallenge\Partnership\Value;

class Identifier
{
    private int $identifier;

    public function __construct(int $identifier)
    {
        $this->identifier = $identifier;
    }

    public function asInt(): int
    {
        return $this->identifier;
    }
}
