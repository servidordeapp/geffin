<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Client extends BaseModel
{
    protected $fillable = [
        'first_name',
        'last_name',
        'document_type',
        'document',
        'email',
        'phone',
    ];

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'document_type' => 'required',
            'document' => ['required'],
            'email' => ['required', 'email'],
            'phone' => 'required',
        ];
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function mainAddress(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable')->where('is_main', true);
    }

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }
}
