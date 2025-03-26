<?php

namespace App\Services\PaymentGateway\Asaas\Core;

abstract class Customer extends Asaas
{
    protected $endpoint = 'customers';

    public function __construct()
    {
        parent::__construct();
        $this->url = "$this->url/$this->endpoint";
    }
}
