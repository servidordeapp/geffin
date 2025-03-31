<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasTenant, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            if (!sessionHasTenant()) {
                $slug = Str::slug($user->name);
                $finalSlug = Tenant::firstWhere('slug', $slug) ? $slug . '-' . Str::random(8) : $slug;
                $tenant = Tenant::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'plan_id' => 1,
                    'slug' => $finalSlug,
                    'status' => 1,
                ]);
                $user->tenant_id = $tenant->id;
            }
        });
    }
}
