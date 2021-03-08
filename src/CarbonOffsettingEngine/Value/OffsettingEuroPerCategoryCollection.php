<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\CarbonOffsettingEngine\Value;

use Yook\YookCodeChallenge\Exception\CollectionElementDoesNotExistException;

class OffsettingEuroPerCategoryCollection
{
    /**
     * @var array<int, OffsettingEuroPerCategory>
     */
    private array $offsettingEuroPerCategory = [];

    public function addOffsettingEuroPerCategory(int $key, OffsettingEuroPerCategory $offsettingEuroPerCategory): void
    {
        $this->offsettingEuroPerCategory[$key] = $offsettingEuroPerCategory;
    }

    public function getElement(int $key): OffsettingEuroPerCategory
    {
        if (!$this->hasElementWithInternalKey($key)) {
            $message = sprintf('Key "%s" does not exist in collection', $key);
            throw new CollectionElementDoesNotExistException($message);
        }

        return $this->offsettingEuroPerCategory[$key];
    }

    private function hasElementWithInternalKey(int $key): bool
    {
        return array_key_exists($key, $this->offsettingEuroPerCategory);
    }
}
