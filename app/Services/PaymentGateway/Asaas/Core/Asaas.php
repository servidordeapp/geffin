<?php

namespace App\Services\PaymentGateway\Asaas\Core;

use Exception;

abstract class Asaas
{
    private string $enviroment;
    protected string $api_key;
    protected string $url;
    protected array $httpHeaders;

    public function __construct()
    {
        $this->enviroment = app()->isProduction() ? 'production' : 'sandbox';
        $this->api_key = config("billing.providers.asaas.{$this->enviroment}.api_key");
        $this->url = config("billing.providers.asaas.{$this->enviroment}.url");

        if (empty($this->api_key)) {
            throw new Exception('API_KEY do Asaas não encontradas');
        }

        if (empty($this->url)) {
            throw new Exception('URL do Asaas não encontradas');
        }

        $this->httpHeaders = [
            'accept' => 'application/json',
            'access_token' => $this->api_key,
            'content-type' => 'application/json',
        ];
    }
}
