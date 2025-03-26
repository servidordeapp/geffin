<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait CanMakeRequest
{
    /**
     * Summary of makeRequest
     * @param string $httpMethod
     * @return array
     * @throws \GuzzleHttp\Exception\RequestException
     */
    protected function makeRequest(string $httpMethod): array
    {
        $httpClient = new Client();
        $response = $httpClient->request(strtoupper($httpMethod), $this->url, [
            'headers' => $this->httpHeaders,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
