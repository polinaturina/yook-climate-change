<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Value;

use DateTime;
use JetBrains\PhpStorm\Pure;
use Yook\YookCodeChallenge\Value\Exception\InvalidDateTimeException;

class Year
{
    private const REPRESENTATION_OF_THE_YEAR = 'Y';
    private const LOWEST_YEAR_LIMIT = 2020;
    private const HIGHEST_YEAR_LIMIT = 2050;

    private DateTime $dateTime;

    public function __construct(DateTime $dateTime)
    {
        $this->ensureValidYear($dateTime);
        $this->dateTime = $dateTime;
    }

    #[Pure]
    public function asString(): string
    {
        return date_format($this->dateTime, self::REPRESENTATION_OF_THE_YEAR);
    }

    private function ensureValidYear(DateTime $dateTime): void
    {
        $year = date_format($dateTime, self::REPRESENTATION_OF_THE_YEAR);
        if ($year >= self::LOWEST_YEAR_LIMIT && $year <= self::HIGHEST_YEAR_LIMIT) {
            return;
        }

        $message = sprintf('Given year %s is not withing the permitted limit > %s and < %s', $year, self::LOWEST_YEAR_LIMIT, self::HIGHEST_YEAR_LIMIT);
        throw new InvalidDateTimeException($message);
    }
}