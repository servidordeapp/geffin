<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Core;

abstract class Customer extends Asaas
{
    protected $endpoint = 'customers';

    public function __construct()
    {
        parent::__construct();
        $this->url = "$this->url/$this->endpoint";
    }
}
