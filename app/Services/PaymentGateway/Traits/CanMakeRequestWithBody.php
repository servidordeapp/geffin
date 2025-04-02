<?php

namespace App\Services\PaymentGateway\Traits;

use App\Services\PaymentGateway\Interfaces\PaymentProviderEncoderInterface;
use GuzzleHttp\Client;

trait CanMakeRequestWithBody
{
    /**
     * Summary of makeRequest
     *
     * @throws \GuzzleHttp\Exception\RequestException
     */
    protected function makeRequest(PaymentProviderEncoderInterface $encodedData, string $httpMethod): array
    {
        $httpClient = new Client;
        $response = $httpClient->request(strtoupper($httpMethod), $this->url, [
            'body' => $encodedData,
            'headers' => $this->httpHeaders,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
