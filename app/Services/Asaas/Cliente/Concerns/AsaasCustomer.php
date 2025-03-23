<?php

namespace App\Services\Asaas\Cliente\Concerns;

use App\Interfaces\PaymentProviderConsumerInterface;
use InvalidArgumentException;

final class AsaasCustomer implements PaymentProviderConsumerInterface
{
    /**
     * Summary of __construct
     * @param string $name Nome do cliente
     * @param string $cpfCnpj CPF ou CNPJ do cliente
     * @param string $email Email do cliente
     * @param string $phone Fone fixo
     * @param string $mobilePhone Fone celular
     * @param string $address Logradouro
     * @param string $addressNumber Número do endereço
     * @param string $complement Complemento do endereço (máx. 255 caracteres)
     * @param string $province Bairro
     * @param string $postalCode CEP do endereço
     * @param string $externalReference Identificador do cliente no seu sistema
     * @param bool $notificationDisabled true para desabilitar o envio de notificações de cobrança
     * @param string $additionalEmails Emails adicionais para envio de notificações de cobrança separados por ","
     * @param string $municipalInscription Inscrição municipal do cliente
     * @param string $stateInscription Inscrição estadual do cliente
     * @param string $observations Observações adicionais
     * @param string $groupName Nome do grupo ao qual o cliente pertence
     * @param string $company Empresa
     * @param bool $foreignCustomer informe true caso seja pagador estrangeiro
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private ?string $name = null,
        private ?string $cpfCnpj = null,
        private ?string $email = null,
        private ?string $phone = null,
        private ?string $mobilePhone = null,
        private ?string $address = null,
        private ?string $addressNumber = null,
        private ?string $complement = null,
        private ?string $province = null,
        private ?string $postalCode = null,
        private ?string $externalReference = null,
        private ?bool $notificationDisabled = true,
        private ?string $additionalEmails = null,
        private ?string $municipalInscription = null,
        private ?string $stateInscription = null,
        private ?string $observations = null,
        private ?string $groupName = null,
        private ?string $company = null,
        private ?bool $foreignCustomer = false,
    ) {
        if (empty($name)) {
            throw new InvalidArgumentException("O nome do cliente deve ser informado");
        }

        if (empty($cpfCnpj)) {
            throw new InvalidArgumentException("O cpf ou cnpj do cliente deve ser informado");
        }

        if (strlen($complement) > 255) {
            throw new InvalidArgumentException("O complemento do endereço deve ter no máximo 255 caracteres");
        }
    }

    private function toArray(): array
    {
        return array_filter([
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
        ], fn ($value) => $value !== null);
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
