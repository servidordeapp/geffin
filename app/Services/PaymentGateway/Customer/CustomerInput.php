<?php

namespace App\Services\PaymentGateway\Customer;

interface CustomerInput
{
    public function validate(): void;

    public function getId(): ?string;
}
