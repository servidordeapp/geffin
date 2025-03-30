<?php

use App\Exceptions\CustomerNotFoundException;
use App\Services\PaymentGateway\Asaas\Customer\AsaasCustomer;

describe('Restore Asaas Customer', function () {
    it('can restore a customer', function () {
        // Arrange
        $customer = AsaasCustomer::first();

        // Act
        AsaasCustomer::restore($customer->getId());

        // Assert
        expect(AsaasCustomer::find($customer->getId()))->deleted->toBeFalse();
    });

    it('can not restore a customer that not exists', function () {
        // Assert
        expect(fn () => AsaasCustomer::restore('invalid-id'))->toThrow(CustomerNotFoundException::class);
    });
});
