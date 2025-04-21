<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends BaseModel
{
    protected $fillable = [
        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'type',
        'is_main',
    ];

    public function casts(): array
    {
        return [
            'isMain' => 'boolean',
        ];
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
