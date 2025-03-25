<?php

namespace App\Services\PaymentGateway\Asaas\Core;

abstract class AsaasCustomer extends AsaasCore
{
    protected $endpoint = 'customers';

    public function __construct()
    {
        parent::__construct();
        $this->url = "$this->url/$this->endpoint";
    }
}
