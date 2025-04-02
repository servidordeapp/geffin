<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns;

use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBilingTypesEnum;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasBillingCycleEnum;
use App\Services\PaymentGateway\Providers\Asaas\Subscription\Enums\AsaasDiscountTypeEnum;
use DateTime;

final class AsaasSubscriptionOutput
{
    private ?string $id = null;

    private ?string $customer;

    private ?DateTime $dateCreated = null;

    private ?string $paymentLink = null;

    private ?float $value;

    private ?DateTime $nextDueDate;

    private ?AsaasBillingCycleEnum $cycle;

    private ?string $description;

    private ?AsaasBilingTypesEnum $billingType;

    private ?bool $deleted;

    private ?string $discountType;

    private ?string $status;

    private ?string $externalReference;

    private ?DateTime $endDate = null;

    private ?int $maxPayments = null;

    private ?bool $sendPaymentByPostalService = false;

    private ?AsaasDiscount $discount = null;

    /**
     * Summary of __construct
     *
     * @param  array  $httpResponse  Resposta HTTP da criação da assinatura
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(
        array $httpResponse,
    ) {

        $this->id = $httpResponse['id'] ?? null;
        $this->dateCreated = $httpResponse['dateCreated'] ?? null;
        $this->customer = $httpResponse['customer'] ?? null;
        $this->paymentLink = $httpResponse['paymentLink'] ?? null;
        $this->value = $httpResponse['value'] ?? null;
        $this->nextDueDate = $httpResponse['nextDueDate'] ?? null;
        $this->cycle = AsaasBillingCycleEnum::tryFrom($httpResponse['cycle']) ?? null;
        $this->description = $httpResponse['description'] ?? null;
        $this->billingType = AsaasBilingTypesEnum::tryFrom($httpResponse['billingType']) ?? null;
        $this->deleted = $httpResponse['deleted'] ?? null;
        $this->status = $httpResponse['status'] ?? null;
        $this->externalReference = $httpResponse['externalReference'] ?? null;
        $this->endDate = $httpResponse['endDate'] ?? null;
        $this->maxPayments = $httpResponse['maxPayments'] ?? null;
        $this->sendPaymentByPostalService = $httpResponse['sendPaymentByPostalService'] ?? null;
        $this->discount = new AsaasDiscount(
            $httpResponse['discount']['value'] ?? null,
            $httpResponse['discount']['dueDateLimitDays'] ?? null,
            AsaasDiscountTypeEnum::tryFrom($httpResponse['discount']['type']) ?? null
        );
        // $this->fine = [
        //     'value' => $httpResponse['fine']['value'] ?? null,
        //     'type' => AsaasDiscountTypeEnum::tryFrom($httpResponse['fine']['type']) ?? null,
        // ];
        // $this->interest = [
        //     'value' => $httpResponse['interest']['value'] ?? null,
        //     'type' => AsaasDiscountTypeEnum::tryFrom($httpResponse['interest']['type']) ?? null,
        // ];
        // $this->split = $httpResponse['split'] ?? null;

    }

    public function __toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
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
