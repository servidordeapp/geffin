<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Subscription\Concerns;

final class AsaasSubscriptionOutput
{
    private ?string $id = null;

    private ?string $customer;

    private ?string $dateCreated = null;

    private ?string $paymentLink = null;

    private ?float $value;

    private ?string $nextDueDate;

    private ?string $cycle;

    private ?string $description;

    private ?string $billingType;

    private ?bool $deleted;

    private ?string $discountType;

    private ?string $status;

    private ?string $externalReference;

    private ?string $endDate = null;

    private ?int $maxPayments = null;

    private ?bool $sendPaymentByPostalService = false;

    private ?array $discount = [];

    private ?array $fine = [];

    private ?array $interest = [];

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
        $this->cycle = $httpResponse['cycle'] ?? null;
        $this->description = $httpResponse['description'] ?? null;
        $this->billingType = $httpResponse['billingType'] ?? null;
        $this->deleted = $httpResponse['deleted'] ?? null;
        $this->discountType = $httpResponse['discountType'] ?? null;
        $this->status = $httpResponse['status'] ?? null;
        $this->externalReference = $httpResponse['externalReference'] ?? null;
        $this->endDate = $httpResponse['endDate'] ?? null;
        $this->maxPayments = $httpResponse['maxPayments'] ?? null;
        $this->sendPaymentByPostalService = $httpResponse['sendPaymentByPostalService'] ?? null;
        $this->discount = [
            "value" => $httpResponse['discount']['value'] ?? null,
            "dueDateLimitDays" => $httpResponse['discount']['dueDateLimitDays'] ?? null,
            "type" => $httpResponse['discount']['type'] ?? null
        ];
        $this->fine = [
            'value' => $httpResponse['fine']['value'] ?? null,
            'type' => $httpResponse['fine']['type'] ?? null,
        ];
        $this->interest = [
            'value' => $httpResponse['interest']['value'] ?? null,
            'type' => $httpResponse['interest']['type'] ?? null,
        ];
        // $this->split = $httpResponse['split'] ?? null;

    }

    public function toArray()
    {
        // return $this;
        return array_filter([
            'id' => $this->id,
            'customer' => $this->customer,
            'dateCreated' => $this->dateCreated,
            'paymentLink' => $this->paymentLink,
            'value' => $this->value,
            'nextDueDate' => $this->nextDueDate,
            'cycle' => $this->cycle,
            'description' => $this->description,
            'billingType' => $this->billingType,
            'deleted' => $this->deleted,
            'discountType' => $this->discountType,
            'status' => $this->status,
            'externalReference' => $this->externalReference,
            'endDate' => $this->endDate,
            'maxPayments' => $this->maxPayments,
            'sendPaymentByPostalService' => $this->sendPaymentByPostalService,
            'discount' => $this->discount,
            'fine' => $this->fine,
            'interest' => $this->interest,
        ], fn($value) => $value !== null);
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}
