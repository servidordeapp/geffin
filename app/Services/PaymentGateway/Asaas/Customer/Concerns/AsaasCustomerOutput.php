<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Concerns;

use App\Contracts\Customer\CustomerOutput;

final readonly class AsaasCustomerOutput implements CustomerOutput
{
    public ?string $id;

    public ?string $dateCreated;

    public ?string $name;

    public ?string $email;

    public ?string $company;

    public ?string $phone;

    public ?string $mobilePhone;

    public ?string $address;

    public ?string $addressNumber;

    public ?string $complement;

    public ?string $province;

    public ?string $postalCode;

    public ?string $cpfCnpj;

    public ?string $personType;

    public ?bool $deleted;

    public ?string $additionalEmails;

    public ?string $externalReference;

    public ?bool $notificationDisabled;

    public ?string $observations;

    public ?string $municipalInscription;

    public ?string $stateInscription;

    public ?bool $canDelete;

    public ?string $cannotBeDeletedReason;

    public ?bool $canEdit;

    public ?string $cannotEditReason;

    public ?string $city;

    public ?string $cityName;

    public ?string $state;

    public ?string $country;

    /**
     * Summary of __construct
     *
     * @param  array  $httpResponse  Resposta HTTP da criação do cliente
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

    public function getId(): string
    {
        return $this->id;
    }
}
