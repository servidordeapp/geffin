<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns;

use App\Services\PaymentGateway\Interfaces\PaymentProviderEncoderInterface;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasDiscountTypeEnum;
use InvalidArgumentException;

final class AsaasDiscount implements PaymentProviderEncoderInterface
{
    /**
     * Summary of __construct
     *
     * @param  float  $value  Valor percentual ou fixo de desconto a ser aplicado sobre o valor da cobrança
     * @param  mixed  $dueDateLimitDays  Dias antes do vencimento para aplicar desconto. Ex: 0 = até o vencimento, 1 = até um dia antes, 2 = até dois dias antes, e assim por diante
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasDiscountTypeEnum  $type  Tipo de desconto
     */
    private function __construct(
        private ?float $value = null,
        private ?int $dueDateLimitDays = 0,
        private ?AsaasDiscountTypeEnum $type = null,
    ) {
        if ($value !== null && $type === null) {
            throw new InvalidArgumentException('O tipo de desconto deve ser informado');
        }
    }

    private function toArray(): array
    {
        return array_filter([
            'value' => $this->value,
            'dueDateLimitDays' => $this->dueDateLimitDays,
            'type' => $this->type,
        ], fn ($value) => $value !== null);
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
