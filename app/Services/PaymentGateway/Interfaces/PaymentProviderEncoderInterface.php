<?php

namespace App\Services\PaymentGateway\Interfaces;

interface PaymentProviderEncoderInterface
{
    public function __toString(): string;
}
