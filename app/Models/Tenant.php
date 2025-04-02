<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'plan_id',
        'phone',
        'status',
        'document',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
