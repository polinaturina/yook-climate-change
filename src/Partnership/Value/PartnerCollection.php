<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

use ArrayIterator;
use IteratorAggregate;
use Yook\YookCodeChallenge\Exception\DuplicatedKeyException;
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
}
