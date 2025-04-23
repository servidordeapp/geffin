<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Charge extends BaseModel
{
    protected $fillable = [
        'client_id',
        'description',
        'value',
        'due_date',
        'status',
        'gateway',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }
}
