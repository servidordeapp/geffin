<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait CanMakeRequest
{
    /**
     * Summary of makeRequest
     *
     * @throws \GuzzleHttp\Exception\RequestException
     */
    protected function makeRequest(string $httpMethod): array
    {
        $httpClient = new Client;
        $response = $httpClient->request(strtoupper($httpMethod), $this->url, [
            'headers' => $this->httpHeaders,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
