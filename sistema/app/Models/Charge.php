<?php

namespace App\Models;

use App\Traits\HasTenant;

class Charge extends BaseModel
{
    use HasTenant;

    protected $fillable = [
        'client_id',
        'value',
        'due_date',
        'status',
        'gateway',
    ];
}
