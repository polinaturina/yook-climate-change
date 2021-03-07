<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership;

use Yook\YookCodeChallenge\Partnership\Value\PartnershipPayload;

class PartnershipPayloadMapper
{
    public function map(string $body): PartnershipPayload
    {
        return new PartnershipPayload($this->getBodyAsArray($body));
    }

    private function getBodyAsArray(string $body): array
    {
        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }
}
