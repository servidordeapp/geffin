<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Concerns;

use App\Contracts\Customer\CustomerOutput;
use InvalidArgumentException;

final class AsaasCustomerOutput implements CustomerOutput
{
    public ?string $id = null;
    public ?string $dateCreated = null;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $company = null;
    public ?string $phone = null;
    public ?string $mobilePhone = null;
    public ?string $address = null;
    public ?string $addressNumber = null;
    public ?string $complement = null;
    public ?string $province = null;
    public ?string $postalCode = null;
    public ?string $cpfCnpj = null;
    public ?string $personType = null;
    public ?string $deleted = null;
    public ?string $additionalEmails = null;
    public ?string $externalReference = null;
    public bool $notificationDisabled;
    public ?string $observations = null;
    public ?string $municipalInscription = null;
    public ?string $stateInscription = null;
    public bool $canDelete;
    public ?string $cannotBeDeletedReason = null;
    public bool $canEdit;
    public ?string $cannotEditReason = null;
    public ?string $city = null;
    public ?string $cityName = null;
    public ?string $state = null;
    public ?string $country = null;
    /**
     * Summary of __construct
     * @param array $httpResponse Resposta HTTP da criação do cliente
     * @throws \InvalidArgumentException
     */
    public function __construct(
        array $httpResponse,
    ) {
        $this->id = $httpResponse['id'] ?? null;
        $this->dateCreated = $httpResponse['dateCreated'] ?? null;
        $this->name = $httpResponse['name'] ?? null;
        $this->email = $httpResponse['email'] ?? null;
        $this->company = $httpResponse['company'] ?? null;
        $this->phone = $httpResponse['phone'] ?? null;
        $this->mobilePhone = $httpResponse['mobilePhone'] ?? null;
        $this->address = $httpResponse['address'] ?? null;
        $this->addressNumber = $httpResponse['addressNumber'] ?? null;
        $this->complement = $httpResponse['complement'] ?? null;
        $this->province = $httpResponse['province'] ?? null;
        $this->postalCode = $httpResponse['postalCode'] ?? null;
        $this->cpfCnpj = $httpResponse['cpfCnpj'] ?? null;
        $this->personType = $httpResponse['personType'] ?? null;
        $this->deleted = $httpResponse['deleted'] ?? null;
        $this->additionalEmails = $httpResponse['additionalEmails'] ?? null;
        $this->externalReference = $httpResponse['externalReference'] ?? null;
        $this->notificationDisabled = $httpResponse['notificationDisabled'] ?? null;
        $this->observations = $httpResponse['observations'] ?? null;
        $this->municipalInscription = $httpResponse['municipalInscription'] ?? null;
        $this->stateInscription = $httpResponse['stateInscription'] ?? null;
        $this->canDelete = $httpResponse['canDelete'] ?? null;
        $this->cannotBeDeletedReason = $httpResponse['cannotBeDeletedReason'] ?? null;
        $this->canEdit = $httpResponse['canEdit'] ?? null;
        $this->cannotEditReason = $httpResponse['cannotEditReason'] ?? null;
        $this->city = $httpResponse['city'] ?? null;
        $this->cityName = $httpResponse['cityName'] ?? null;
        $this->state = $httpResponse['state'] ?? null;
        $this->country = $httpResponse['country'] ?? null;
    }

    public function __toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'dateCreated' => $this->dateCreated,
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'phone' => $this->phone,
            'mobilePhone' => $this->mobilePhone,
            'address' => $this->address,
            'addressNumber' => $this->addressNumber,
            'complement' => $this->complement,
            'province' => $this->province,
            'postalCode' => $this->postalCode,
            'cpfCnpj' => $this->cpfCnpj,
            'personType' => $this->personType,
            'deleted' => $this->deleted,
            'additionalEmails' => $this->additionalEmails,
            'externalReference' => $this->externalReference,
            'notificationDisabled' => $this->notificationDisabled,
            'observations' => $this->observations,
            'municipalInscription' => $this->municipalInscription,
            'stateInscription' => $this->stateInscription,
            'canDelete' => $this->canDelete,
            'cannotBeDeletedReason' => $this->cannotBeDeletedReason,
            'canEdit' => $this->canEdit,
            'cannotEditReason' => $this->cannotEditReason,
            'city' => $this->city,
            'cityName' => $this->cityName,
            'state' => $this->state,
            'country' => $this->country,
        ], fn ($value) => $value !== null || $value);
    }

    public function __toString(): string
    {
        return json_encode($this->__toArray());
    }
}
