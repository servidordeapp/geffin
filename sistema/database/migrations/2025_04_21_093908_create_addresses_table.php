<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('tenant_id')->index()->constrained();
            $table->foreignId('addressable_id');
            $table->string('addressable_type');
            $table->string('cep', 11);
            $table->string('street', 100);
            $table->string('number', 8);
            $table->string('complement', 100)->nullable();
            $table->string('neighborhood', 100);
            $table->string('city');
            $table->string('state', 50);
            $table->string('type');
            $table->tinyInteger('is_main')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
