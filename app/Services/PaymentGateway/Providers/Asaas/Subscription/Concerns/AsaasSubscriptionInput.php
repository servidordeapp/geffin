<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns;

use App\Services\PaymentGateway\Providers\Asaas\Customer\Concerns\AsaasCustomerOutput;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum;
use App\Services\PaymentGateway\Interfaces\PaymentProviderEncoderInterface;
use DateTime;
use InvalidArgumentException;

final class AsaasSubscriptionInput implements PaymentProviderEncoderInterface
{
    /**
     * Summary of __construct
     *
     * @param  AsaasCustomerOutput  $customer  Identificador único do cliente no Asaas
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum  $billingType  Forma de pagamento
     * @param  float  $value  Valor da assinatura
     * @param  \DateTime  $nextDueDate  Vencimento da primeira cobrança
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasDiscount  $discount  Informações de desconto
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum  $cycle  Periodicidade da cobrança
     * @param  string  $description  Descrição da assinatura (máx. 500 caracteres)
     * @param  \DateTime  $endDate  Data limite para vencimento das cobranças
     * @param  int  $maxPayments  Número máximo de cobranças a serem geradas para esta assinatura
     * @param  string  $externalReference  Identificador da assinatura no seu sistema
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private AsaasCustomerOutput $customer,
        private AsaasBilingTypesEnum $billingType,
        private float $value,
        private DateTime $nextDueDate,
        private ?AsaasDiscount $discount,
        private AsaasBillingCycleEnum $cycle,
        private string $description,
        private ?DateTime $endDate,
        private ?int $maxPayments,
        private string $externalReference,
    ) {
        if (strlen($this->description) > 500) {
            throw new InvalidArgumentException('A descrição da assinatura deve ter no máximo 500 caracteres. (Atual: '.strlen($this->description).' caracteres)');
        }

        if ($this->nextDueDate->format('Y-m-d') < (new DateTime)->format('Y-m-d')) {
            throw new InvalidArgumentException('A data de vencimento da primeira cobrança deve ser posterior ou igual ao dia atual.');
        }

        if ($this->endDate && $this->endDate->format('Y-m-d') < $this->nextDueDate->format('Y-m-d')) {
            throw new InvalidArgumentException('A data limite para vencimento das cobranças deve ser posterior ou igual ao dia de vencimento da primeira cobrança.');
        }
    }

    public function __toArray(): array
    {
        return array_filter([
            'customer' => $this->customer->id,
            'billingType' => $this->billingType,
            'value' => $this->value,
            'nextDueDate' => $this->nextDueDate->format('Y-m-d'),
            'discount' => $this->discount,
            'cycle' => $this->cycle->value,
            'description' => $this->description,
            'endDate' => $this->endDate,
            'maxPayments' => $this->maxPayments,
            'externalReference' => $this->externalReference,
        ], fn ($value) => $value !== null);
    }

    public function __toString(): string
    {
        return json_encode($this->__toArray());
    }
}
