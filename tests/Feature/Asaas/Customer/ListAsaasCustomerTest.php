<?php

use App\Contracts\Customer\CustomerOutput;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

describe('list customers', function () {
    it('returns a List of Customers of the type of CustomerOutput', function ($offset, $limit) {
        $customers = AsaasCustomer::get(['offset' => $offset, 'limit' => $limit]);

        expect($customers['data'])->toBeArray();
        expect(count($customers['data']))->toEqual($limit);
        expect($customers['data'])->each()->toBeInstanceOf(CustomerOutput::class);
    })->with([
        [0, 10],
        [10, 10],
        [20, 10],
    ]);
});
