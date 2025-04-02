<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription;

use App\Services\PaymentGateway\Providers\Asaas\Core\Subscription;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionInput;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasSubscriptionOutput;
use App\Services\PaymentGateway\Traits\CanMakeRequestWithBody;

class CreateAsaasSubscription extends Subscription
{
    use CanMakeRequestWithBody;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(AsaasSubscriptionInput $subscriptionInput): AsaasSubscriptionOutput
    {
        $httpResponse = $this->makeRequest($subscriptionInput, httpMethod: 'POST');

        return new AsaasSubscriptionOutput($httpResponse);
    }
}
