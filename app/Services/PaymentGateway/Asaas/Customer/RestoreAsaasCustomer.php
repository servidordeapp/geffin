<?php

namespace App\Services\PaymentGateway\Asaas\Customer;

use App\Services\PaymentGateway\Asaas\Core\AsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Traits\CanMakeRequest;

class RestoreAsaasCustomer extends AsaasCustomer
{
    use CanMakeRequest;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(string $id): AsaasCustomerOutput
    {
        $this->url = "$this->url/$id/restore";
        return new AsaasCustomerOutput($this->makeRequest(httpMethod: 'POST'));
    }
}
