<?php

namespace App\Services\PaymentGateway\Asaas\Core;

abstract class Subscription extends Asaas
{
    protected $endpoint = 'subscriptions';

    public function __construct()
    {
        parent::__construct();
        $this->url = "$this->url/$this->endpoint";
    }
}
