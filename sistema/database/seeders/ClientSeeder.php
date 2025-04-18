<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()
            ->count(800)
            ->for(Tenant::factory()->create())
            ->create();
    }
}
