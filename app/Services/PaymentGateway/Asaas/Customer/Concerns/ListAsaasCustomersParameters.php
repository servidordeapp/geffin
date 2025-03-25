<?php

namespace App\Services\PaymentGateway\Asaas\Customer\Concerns;

use InvalidArgumentException;

final class ListAsaasCustomersParameters
{
    /**
     * Summary of __construct
     * @param int $offset Elemento inicial da lista
     * @param int $limit Número de elementos da lista (max: 100)
     * @param string $name Filtrar por nome
     * @param string $email Filtrar por email
     * @param string $cpfCnpj Filtrar por CPF ou CNPJ
     * @param string $groupName Filtrar por grupo
     * @param string $externalReference Filtrar pelo Identificador do seu sistema
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private ?int $offset = null,
        private ?int $limit = null,
        private ?string $name = null,
        private ?string $email = null,
        private ?string $cpfCnpj = null,
        private ?string $groupName = null,
        private ?string $externalReference = null,
    ) {
        if ($limit > 100) {
            throw new InvalidArgumentException("A quantidade máxima de clientes por consulta é 100");
        }
    }

    public function __toArray(): array
    {
        return array_filter([
            'offset' => $this->offset,
            'limit' => $this->limit,
            'name' => $this->name,
            'email' => $this->email,
            'cpfCnpj' => $this->cpfCnpj,
            'groupName' => $this->groupName,
            'externalReference' => $this->externalReference,
        ], fn($value) => $value !== null);
    }

    public function toQueryString(): string
    {
        return http_build_query($this->__toArray());
    }
}
