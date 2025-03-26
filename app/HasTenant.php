<?php

namespace App;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTenant
{
    protected static function bootHasTenant()
    {
        static::addGlobalScope(new TenantScope);

        if (sessionHasTenant()) {
            static::creating(function ($model) {
                $model->tenant_id = session()->get('tenant_id');
            });
        }
    }

    public function Tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
