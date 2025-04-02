<?php

namespace App\Services\PaymentGateway\Providers\Asaas\Customer\Concerns;

use App\Services\PaymentGateway\Customer\CustomerInput;
use App\Services\PaymentGateway\Interfaces\PaymentProviderEncoderInterface;
use App\Services\PaymentGateway\Utils\Cnpj;
use App\Services\PaymentGateway\Utils\Cpf;
use InvalidArgumentException;

final readonly class AsaasCustomerInput implements CustomerInput, PaymentProviderEncoderInterface
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
        private array $input,
    ) {
        $this->validate();

        $this->id = $this->input['id'] ?? null;
        $this->name = $this->input['name'] ?? null;
        $this->cpfCnpj = $this->getDocument();
        $this->email = $this->input['email'] ?? null;
        $this->phone = $this->input['phone'] ?? null;
        $this->mobilePhone = $this->input['mobilePhone'] ?? null;
        $this->address = $this->input['address'] ?? null;
        $this->addressNumber = $this->input['addressNumber'] ?? null;
        $this->complement = $this->input['complement'] ?? null;
        $this->province = $this->input['province'] ?? null;
        $this->postalCode = $this->input['postalCode'] ?? null;
        $this->externalReference = $this->input['externalReference'] ?? null;
        $this->notificationDisabled = $this->input['notificationDisabled'] ?? null;
        $this->additionalEmails = $this->input['additionalEmails'] ?? null;
        $this->municipalInscription = $this->input['municipalInscription'] ?? null;
        $this->stateInscription = $this->input['stateInscription'] ?? null;
        $this->observations = $this->input['observations'] ?? null;
        $this->groupName = $this->input['groupName'] ?? null;
        $this->company = $this->input['company'] ?? null;
        $this->foreignCustomer = $this->input['foreignCustomer'] ?? null;
    }

    /**
     * Summary of validate
     *
     * @param  array  $input
     *
     * @throws \InvalidArgumentException
     */
    public function validate(): void
    {
        if (empty($this->input['name']) || $this->input['name'] === null) {
            throw new InvalidArgumentException('O nome do cliente deve ser informado');
        }

        if (isset($this->input['complement']) && $this->input['complement'] !== null && strlen($this->input['complement']) > 255) {
            throw new InvalidArgumentException('O complemento do endereço deve ter no máximo 255 caracteres');
        }
    }

    private function getDocument(): string
    {
        if (empty($this->input['cpfCnpj']) || $this->input['cpfCnpj'] === null) {
            throw new InvalidArgumentException('O Cpf ou Cnpj do cliente deve ser informado');
        }

        if (strlen(preg_replace('/\D/', '', $this->input['cpfCnpj'])) === 11) {
            return (new Cpf($this->input['cpfCnpj']))->get();
        }

        return (new Cnpj($this->input['cpfCnpj']))->get();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function __toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'cpfCnpj' => $this->cpfCnpj,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobilePhone' => $this->mobilePhone,
            'address' => $this->address,
            'addressNumber' => $this->addressNumber,
            'complement' => $this->complement,
            'province' => $this->province,
            'postalCode' => $this->postalCode,
            'externalReference' => $this->externalReference,
            'notificationDisabled' => $this->notificationDisabled,
            'additionalEmails' => $this->additionalEmails,
            'municipalInscription' => $this->municipalInscription,
            'stateInscription' => $this->stateInscription,
            'observations' => $this->observations,
            'groupName' => $this->groupName,
            'company' => $this->company,
            'foreignCustomer' => $this->foreignCustomer,
        ], fn ($value) => $value !== null);
    }

    public function __toString(): string
    {
        return json_encode($this->__toArray());
    }
}
