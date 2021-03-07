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

//    public function get()
//    {
//        $client = new Client();
//        $response = $client->request('GET', 'https://api.mocki.io/v1/1bca1702');
//        $body = $response->getBody()->getContents();
//        $array = json_decode($body, true);
//
//        $mapper = new Mapper();
//        $collection = new PartnerCollection();
//
//        foreach ($array as $a) {
//            $category = $a['category'];
//
//            if ($category === 1) {
//                $partner = $mapper->map($a, new CategoryOne(1));
//                $collection->add($partner);
//            }
////            switch ($category) {
////                case 1:
////                    $partner = $mapper->map($a, new CategoryOne(1));
////                default:
////                    return;
////            }
//        }
//
//        $firstCategoryCollection = $collection->getFirstCategegoryCollection();
//        if (count($firstCategoryCollection) > 1) {
//            $min = $firstCategoryCollection[0]->getPrice()->getValue();
//            foreach ($firstCategoryCollection as $item) {
//                if ($item->getPrice()->getValue() < $min) {
//                    $min = $item->getPrice()->getValue();
//                }
//                var_dump($min);
//                return $min;
//            }
//        } else {
//            return $firstCategoryCollection[0]['price'];
//        }
//
//
//die();
//    }
}
