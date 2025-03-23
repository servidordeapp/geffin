<?php

namespace App\Traits;

use App\Interfaces\PaymentProviderConsumerInterface;
use GuzzleHttp\Client;

trait CanMakeRequestWithBody
{
    protected function makeRequest(PaymentProviderConsumerInterface $customer, string $httpMethod): array
    {
        $httpClient = new Client();
        $response = $httpClient->request(strtoupper($httpMethod), $this->url, [
            'body' => $customer,
            'headers' => $this->httpHeaders,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
