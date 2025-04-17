<?php

namespace App\Models;

use App\Traits\HasTenant;

class BankAccount extends BaseModel
{
    use HasTenant;

    protected $fillable = [
        'descricao',
        'conta',
        'conta_dv',
        'agencia',
        'agencia_dv',
        'variacao_carteira',
        'convenio',
        'multa',
        'juros',
        'desconto',
    ];
}
