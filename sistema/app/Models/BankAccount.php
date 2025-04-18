<?php

namespace App\Models;

use App\Traits\HasTenant;

class BankAccount extends BaseModel
{
    use HasTenant;
    protected $table = "bank_accounts";

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

    public function rules()
    {
        return [
            'descricao' => 'required',
            'conta' => 'required',
            'conta_dv' => 'required',
            'agencia' => 'required',
            'agencia_dv' => 'required',
            'variacao_carteira' => 'required',
            'convenio' => 'required',
            'multa' => 'nullable',
            'juros' => 'nullable',
            'desconto' => 'nullable',
        ];
    }
}
