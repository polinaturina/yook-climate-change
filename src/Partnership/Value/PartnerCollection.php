<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

use ArrayIterator;
use IteratorAggregate;
use Yook\YookCodeChallenge\Exception\DuplicatedKeyException;

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

//    /**
//     * @return array<string, Partner>
//     */
//    public function getFirstCategegoryCollection()
//    {
//        $collection = [];
//        foreach ($this->partners as $partner) {
//            if ($partner->getCatgory()->getNumber() === 1) {
//                $collection[] = $partner;
//            }
//        }
//
//        return $collection;
//    }
}
