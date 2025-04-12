<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns;

use App\Services\PaymentGateway\Interfaces\PaymentProviderEncoderInterface;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum;
use App\Services\PaymentGateway\Utils\Trial;
use DateTime;
use InvalidArgumentException;
use Ramsey\Uuid\Type\Decimal;

final readonly class AsaasSubscriptionInput implements PaymentProviderEncoderInterface
{
    private string $customer;

    private AsaasBilingTypesEnum $billingType;

    private Decimal $value;

    private Trial $nextDueDate;

    private ?AsaasDiscount $discount;

    private AsaasBillingCycleEnum $cycle;

    private ?string $description;

    private ?string $endDate;

    private ?int $maxPayments;

    private string $externalReference;

    /**
     * Summary of __construct
     *
     * @param  string  $customer  Identificador único do cliente no Asaas
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum  $billingType  Forma de pagamento
     * @param  Decimal  $value  Valor da assinatura
     * @param  Trial  $nextDueDate  Vencimento da primeira cobrança
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns\AsaasDiscount  $discount  Informações de desconto
     * @param  \App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum  $cycle  Periodicidade da cobrança
     * @param  string  $description  Descrição da assinatura (máx. 500 caracteres)
     * @param  string  $endDate  Data limite para vencimento das cobranças
     * @param  int  $maxPayments  Número máximo de cobranças a serem geradas para esta assinatura
     * @param  string  $externalReference  Identificador da assinatura no seu sistema
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private array $data,
    ) {
        $this->validate();

        $this->customer = $data['customer'];
        $this->billingType = $data['billingType'];
        $this->value = new Decimal($data['value']);
        $this->nextDueDate = $data['nextDueDate'];
        $this->discount = new AsaasDiscount(...$data['discount'] ?? []) ?? null;
        $this->cycle = $data['cycle'];
        $this->description = $data['description' ] ?? null;
        $this->endDate = $data['endDate'] ?? null;
        $this->maxPayments = $data['maxPayments'] ?? null;
        $this->externalReference = $data['externalReference'];
    }

    private function validate(): void
    {
        if (!array_key_exists('customer', $this->data)) {
            throw new InvalidArgumentException('O identificador único do cliente no Asaas deve ser informado');
        }

        if (!array_key_exists('billingType', $this->data)) {
            throw new InvalidArgumentException('A forma de pagamento deve ser informada');
        }

        if (!$this->data['billingType'] instanceof AsaasBilingTypesEnum) {
            throw new InvalidArgumentException('A periodicidade da cobrança deve do tipo ' . AsaasBilingTypesEnum::class . ' e deve ser informada');
        }

        if (!array_key_exists('value', $this->data)) {
            throw new InvalidArgumentException('O valor da assinatura deve ser informado');
        }

        if (!array_key_exists('nextDueDate', $this->data)) {
            throw new InvalidArgumentException('A data de vencimento da primeira cobrança deve ser informada');
        }

        if (!array_key_exists('cycle', $this->data)) {
            throw new InvalidArgumentException('A periodicidade da cobrança deve ser informada');
        }

        if (!$this->data['cycle'] instanceof AsaasBillingCycleEnum) {
            throw new InvalidArgumentException('A periodicidade da cobrança deve do tipo ' . AsaasBillingCycleEnum::class . ' e deve ser informada');
        }

        if (!array_key_exists('externalReference', $this->data)) {
            throw new InvalidArgumentException('O identificador da assinatura no seu sistema deve ser informado');
        }

        if (isset(($this->data['description'])) && strlen($this->data['description']) > 500) {
            throw new InvalidArgumentException('A descrição da assinatura deve ter no máximo 500 caracteres. (Atual: ' . strlen($this->description) . ' caracteres)');
        }

        if ($this->data['nextDueDate']->get() < (new Trial())->get()) {
            throw new InvalidArgumentException('A data de vencimento da primeira cobrança deve ser posterior ou igual ao dia atual.');
        }

        // if ((new DateTime($this->data['nextDueDate']))->format('Y-m-d') < (new DateTime)->format('Y-m-d')) {
        //     throw new InvalidArgumentException('A data de vencimento da primeira cobrança deve ser posterior ou igual ao dia atual.');
        // }

        if (isset($this->data['endDate']) && (new DateTime($this->data['endDate']))->format('Y-m-d') < (new DateTime($this->data['nextDueDate']))->format('Y-m-d')) {
            throw new InvalidArgumentException('A data limite para vencimento das cobranças deve ser posterior ou igual ao dia de vencimento da primeira cobrança.');
        }
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
            'billingType' => $this->billingType->value,
            'value' => $this->value->__toString(),
            'nextDueDate' => $this->nextDueDate->get(),
            'discount' => $this->discount->toArray(),
            'cycle' => $this->cycle->value,
            'description' => $this->description,
            'endDate' => $this->endDate,
            'maxPayments' => $this->maxPayments,
            'externalReference' => $this->externalReference,
        ], fn($value) => $value !== null && !empty($value));
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}
