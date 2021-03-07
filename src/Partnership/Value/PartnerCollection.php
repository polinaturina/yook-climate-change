<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

use ArrayIterator;
use IteratorAggregate;
use Yook\YookCodeChallenge\Exception\CollectionElementDoesNotExistException;
use Yook\YookCodeChallenge\Exception\DuplicatedKeyException;
use Yook\YookCodeChallenge\Exception\EmptyCollectionException;
use Yook\YookCodeChallenge\Partnership\Value\Category\Category;

class PartnerCollection implements IteratorAggregate
{
    /**
     * @var array<int, Partner>
     */
    private array $partners = [];

    public function addPartner(Partner $partner): void
    {
        $key = (string) $partner->getIdentifier()->asInt();

        if (isset($this->orderItems[$key])) {
            throw new DuplicatedKeyException(sprintf('Key %s was duplicated', $key));
        }

        $this->partners[$key] = $partner;
    }

    /**
     * @return ArrayIterator|array<int, Partner>|Partner[]
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->partners);
    }

    public function findMatchingPartners(Category $category): PartnerCollection
    {
        $collection = new self();

        foreach ($this->partners as $partner) {
            if ($partner->getCategory()->getIdentifier() === $category->getIdentifier()) {
                $collection->addPartner($partner);
            }
        }

        return $collection;
    }

    public function count(): int
    {
        return count($this->partners);
    }

    public function getFirst(): Partner
    {
        if ($this->count() < 1) {
            $message = 'Unable to retrieve first object from an empty collection';
            throw new EmptyCollectionException($message);
        }

        $this->rewind();

        return $this->current();
    }

    public function getElement(int $key): Partner
    {
        if (!$this->hasElementWithInternalKey($key)) {
            $message = sprintf('Key "%s" does not exist in collection', $key);
            throw new CollectionElementDoesNotExistException($message);
        }

        return $this->partners[$key];
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    private function rewind(): void
    {
        reset($this->partners);
    }

    private function current(): Partner
    {
        return current($this->partners);
    }

    private function hasElementWithInternalKey(int $key): bool
    {
        return array_key_exists($key, $this->partners);
    }
}
