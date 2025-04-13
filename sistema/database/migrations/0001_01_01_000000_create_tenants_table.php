<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('plan_id');
            $table->string('billable_id', 36)->nullable();
            $table->string('name', 100);
            $table->string('slug', 150)->unique()->index();
            $table->string('email', 150)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('document', 17)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('tenants')->updateOrInsert([
            'id' => '80d0491e-28ef-4a0f-96e0-72411a853097',
        ],
            [
                'id' => '80d0491e-28ef-4a0f-96e0-72411a853097',
                'plan_id' => 1,
                'name' => 'Tenant Principal',
                'slug' => 'tenant-principal',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
