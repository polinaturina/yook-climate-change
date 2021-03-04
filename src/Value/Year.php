<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Value;

use DateTime;
use Yook\YookCodeChallenge\Value\Exception\InvalidDateTimeException;

class Year
{
    private const REPRESENTATION_OF_THE_YEAR = 'Y';
    private const LOWEST_YEAR_LIMIT = 2020;
    private const HIGHEST_YEAR_LIMIT = 2050;

    private string $year;

    public function __construct(DateTime $dateTime)
    {
        $year = date_format($dateTime, self::REPRESENTATION_OF_THE_YEAR);
        $this->ensureValidYear($year);
        $this->year = $year;
    }

    public function asInteger(): int
    {
        return (int)$this->year;
    }

    public function asString(): string
    {
        return $this->year;
    }

    private function ensureValidYear(string $year): void
    {
        if ($year >= self::LOWEST_YEAR_LIMIT && $year <= self::HIGHEST_YEAR_LIMIT) {
            return;
        }

        $message = sprintf('Given year %s is not withing the permitted limit > %s and < %s', $year, self::LOWEST_YEAR_LIMIT, self::HIGHEST_YEAR_LIMIT);
        throw new InvalidDateTimeException($message);
    }
}