<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends BaseModel
{
    use HasFactory, HasTenant;

    protected $fillable = [
        'first_name',
        'last_name',
        'document',
        'email',
        'phone',
    ];
}
