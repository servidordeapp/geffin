<?php

namespace App\Services\PaymentGateway\Interfaces;

interface PaymentProviderEncoderInterface
{
    public function toString(): string;
    public function toArray(): array;
}
