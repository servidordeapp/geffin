<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Actions;

use App\Services\PaymentGateway\Asaas\Core\Customer;
use App\Traits\CanMakeRequest;

class DeleteAsaasCustomer extends Customer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id): bool
    {
        $this->url = "$this->url/$id";
        $httpResponse = $this->makeRequest(httpMethod: 'DELETE');
        if ($httpResponse['deleted']) {
            return true;
        }

        return false;
    }
}
