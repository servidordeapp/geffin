<?php

use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Customer\Actions\DeleteAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\Actions\ListAsaasCustomers;

it('can delete a custormer', function () {
    // Arrange
    $customerList = (new ListAsaasCustomers)->execute(['limit' => 1]);
    $customer = $customerList['data'][0];

    // Act
    $result = (new DeleteAsaasCustomer)->execute($customer->id);

    // Assert
    expect($result)->toBe(true);

});

it('can delete a custormer already deleted', function () {
    // Arrange
    $customerList = (new ListAsaasCustomers)->execute(['limit' => 1]);
    $customer = $customerList['data'][0];

    // Act
    $result = (new DeleteAsaasCustomer)->execute($customer->id);
    expect($result)->toBe(true);
    $result = (new DeleteAsaasCustomer)->execute($customer->id);

    // Assert
    expect($result)->toBe(true);
});

it('can not delete a custormer not saved', function () {
    // Assert
    expect(fn() => (new DeleteAsaasCustomer)->execute('invalid-id'))->toThrow(CustomerNotFoundException::class);
});
