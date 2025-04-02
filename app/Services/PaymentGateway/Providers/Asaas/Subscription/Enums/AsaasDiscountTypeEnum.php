<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums;

enum AsaasDiscountTypeEnum: string
{
    case FIXED = 'FIXED';
    case PERCENTAGE = 'PERCENTAGE';
}
