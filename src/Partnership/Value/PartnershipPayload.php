<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership\Value;

class PartnershipPayload
{
    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function asArray(): array
    {
        return $this->payload;
    }
}
