<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installment extends BaseModel
{
    protected $fillable = [
        'charge_id',
        'number',
        'value',
        'paid_value',
        'due_date',
        'paid_date',
        'status',
        'download_link',
        'linha_digitavel',
    ];

    public function charge(): BelongsTo
    {
        return $this->belongsTo(Charge::class);
    }
}
