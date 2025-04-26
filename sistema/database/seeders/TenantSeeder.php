<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\Client;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::factory()
            ->count(rand(1, 5))
            ->has(
                Client::factory()
                    ->has(
                        Charge::factory()
                            ->state(fn (array $attributes, Client $client) => ['tenant_id' => $client->tenant_id])
                            ->count(rand(0, 10))
                    )->count(rand(0, 20))
            )->create();
    }
}
