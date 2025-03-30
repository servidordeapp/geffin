<?php

use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Customer\Actions\DeleteAsaasCustomer;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

it('can delete a custormer', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $result = (new DeleteAsaasCustomer)->execute($customer->getId());

    // Assert
    expect($result)->toBe(true);

});

it('can delete a custormer already deleted', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $result = (new DeleteAsaasCustomer)->execute($customer->getId());
    expect($result)->toBe(true);
    $result = (new DeleteAsaasCustomer)->execute($customer->getId());

    // Assert
    expect($result)->toBe(true);
});

it('can not delete a custormer not saved', function () {
    // Assert
    expect(fn () => (new DeleteAsaasCustomer)->execute('invalid-id'))->toThrow(CustomerNotFoundException::class);
});
