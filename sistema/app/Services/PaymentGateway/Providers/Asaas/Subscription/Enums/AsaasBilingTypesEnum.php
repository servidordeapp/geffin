<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums;

enum AsaasBilingTypesEnum: string
{
    case UNDEFINED = 'UNDEFINED';
    case CREDIT_CARD = 'CREDIT_CARD';
    case BOLETO = 'BOLETO';
    case PIX = 'PIX';
}
