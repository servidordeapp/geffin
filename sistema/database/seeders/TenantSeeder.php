<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::factory()
            ->count(200)
            ->has(
                Client::factory()->count(1000)
            )->create();
    }
}
