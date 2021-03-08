<?php
declare(strict_types=1);

namespace Yook\YookCodeChallenge\Partnership;

use GuzzleHttp\Client;
use Yook\YookCodeChallenge\Partnership\Value\PartnershipPayload;

class PartnerSelectorClient
{
    private const HTTP_GET_METHOD = 'GET';
    private const GET_PARTNERSHIP_JSON_ENDPOINT = 'https://api.mocki.io/v1/1bca1702';

    private Client $httpClient;
    private PartnershipPayloadMapper $partnershipPayloadMapper;
    
    public function __construct(Client $httpClient, PartnershipPayloadMapper $partnershipPayloadMapper)
    {
        $this->httpClient = $httpClient;
        $this->partnershipPayloadMapper = $partnershipPayloadMapper;
    }

    public function getPartnershipPayload(): PartnershipPayload
    {
        $response = $this->httpClient->request(self::HTTP_GET_METHOD, self::GET_PARTNERSHIP_JSON_ENDPOINT);

        return $this->partnershipPayloadMapper->map($response->getBody()->getContents());
    }
}
