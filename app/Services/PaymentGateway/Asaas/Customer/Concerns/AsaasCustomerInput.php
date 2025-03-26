<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Concerns;

use App\Contracts\Customer\CustomerInput;
use App\Interfaces\PaymentProviderEncoderInterface;
use InvalidArgumentException;

final class AsaasCustomerInput implements PaymentProviderEncoderInterface, CustomerInput
{
    private ?string $id; // ID do cliente
    private ?string $name; // Nome do cliente
    private ?string $cpfCnpj; // CPF ou CNPJ do cliente
    private ?string $email; // Email do cliente
    private ?string $phone; // Fone fixo
    private ?string $mobilePhone; // Fone celular
    private ?string $address; // Logradouro
    private ?string $addressNumber; // Número do endereço
    private ?string $complement; // Complemento do endereço (máx. 255 caracteres)
    private ?string $province; // Bairro
    private ?string $postalCode; // CEP do endereço
    private ?string $externalReference; // Identificador do cliente no seu sistema
    private ?bool $notificationDisabled; // true para desabilitar o envio de notificações de cobrança
    private ?string $additionalEmails; // Emails adicionais para envio de notificações de cobrança separados por ","
    private ?string $municipalInscription; // Inscrição municipal do cliente
    private ?string $stateInscription; // Inscrição estadual do cliente
    private ?string $observations; // Observações adicionais
    private ?string $groupName; // Nome do grupo ao qual o cliente pertence
    private ?string $company; // Empresa
    private ?bool $foreignCustomer; // informe true caso seja pagador estrangeiro

    public function __construct(
        array $input,
    ) {
        $this->id = $input['id'] ?? null;
        $this->name = $input['name'] ?? null;
        $this->cpfCnpj = $input['cpfCnpj'] ?? null;
        $this->email = $input['email'] ?? null;
        $this->phone = $input['phone'] ?? null;
        $this->mobilePhone = $input['mobilePhone'] ?? null;
        $this->address = $input['address'] ?? null;
        $this->addressNumber = $input['addressNumber'] ?? null;
        $this->complement = $input['complement'] ?? null;
        $this->province = $input['province'] ?? null;
        $this->postalCode = $input['postalCode'] ?? null;
        $this->externalReference = $input['externalReference'] ?? null;
        $this->notificationDisabled = $input['notificationDisabled'] ?? null;
        $this->additionalEmails = $input['additionalEmails'] ?? null;
        $this->municipalInscription = $input['municipalInscription'] ?? null;
        $this->stateInscription = $input['stateInscription'] ?? null;
        $this->observations = $input['observations'] ?? null;
        $this->groupName = $input['groupName'] ?? null;
        $this->company = $input['company'] ?? null;
        $this->foreignCustomer = $input['foreignCustomer'] ?? null;

        $this->validate();
    }

    /**
     * Summary of validate
     * @param array $input
     * @throws \InvalidArgumentException
     * @return void
     */
    public function validate(): void
    {
        if (empty($this->name) || $this->name === null) {
            throw new InvalidArgumentException("O nome do cliente deve ser informado");
        }

        if (empty($this->cpfCnpj) || $this->cpfCnpj === null) {
            throw new InvalidArgumentException("O cpf ou cnpj do cliente deve ser informado");
        }

        if ($this->complement !== null && strlen($this->complement) > 255) {
            throw new InvalidArgumentException("O complemento do endereço deve ter no máximo 255 caracteres");
        }

    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function __toArray(): array
    {
        return array_filter([
            "id" => $this->id,
            "name" => $this->name,
            "cpfCnpj" => $this->cpfCnpj,
            "email" => $this->email,
            "phone" => $this->phone,
            "mobilePhone" => $this->mobilePhone,
            "address" => $this->address,
            "addressNumber" => $this->addressNumber,
            "complement" => $this->complement,
            "province" => $this->province,
            "postalCode" => $this->postalCode,
            "externalReference" => $this->externalReference,
            "notificationDisabled" => $this->notificationDisabled,
            "additionalEmails" => $this->additionalEmails,
            "municipalInscription" => $this->municipalInscription,
            "stateInscription" => $this->stateInscription,
            "observations" => $this->observations,
            "groupName" => $this->groupName,
            "company" => $this->company,
            "foreignCustomer" => $this->foreignCustomer,
        ], fn($value) => $value !== null);
    }

    public function __toString(): string
    {
        return json_encode($this->__toArray());
    }
}
