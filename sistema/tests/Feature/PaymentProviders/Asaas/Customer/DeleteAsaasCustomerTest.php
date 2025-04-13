<?php

use App\Services\PaymentGateway\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Providers\Asaas\Customer\AsaasCustomer;

it('can delete a custormer', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $result = AsaasCustomer::delete($customer->getId());

    // Assert
    expect($result)->toBe(true);
});

it('can delete a custormer already deleted', function () {
    // Arrange
    $customer = AsaasCustomer::first();

    // Act
    $result = AsaasCustomer::delete($customer->getId());
    expect($result)->toBe(true);
    $result = AsaasCustomer::delete($customer->getId());

    // Assert
    expect($result)->toBe(true);
});

it('can not delete a custormer not saved', function () {
    // Assert
    expect(fn () => AsaasCustomer::delete('invalid-id'))->toThrow(CustomerNotFoundException::class);
});
