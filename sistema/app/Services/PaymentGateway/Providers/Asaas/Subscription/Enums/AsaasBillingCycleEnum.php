<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums;

enum AsaasBillingCycleEnum: string
{
    case WEEKLY = 'WEEKLY';
    case BIWEEKLY = 'BIWEEKLY';
    case MONTHLY = 'MONTHLY';
    case BIMONTHLY = 'BIMONTHLY';
    case QUARTERLY = 'QUARTERLY';
    case SEMIANNUALY = 'SEMIANNUALY';
    case YEARLY = 'YEARLY';
}
