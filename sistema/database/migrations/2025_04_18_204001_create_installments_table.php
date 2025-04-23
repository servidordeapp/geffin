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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('tenant_id')->index()->constrained();
            $table->foreignId('charge_id')->constrained();
            $table->integer('number');
            $table->decimal('value', 8, 2);
            $table->decimal('paid_value', 8, 2)->nullable();
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            $table->string('status', 15);
            $table->string('download_link', 512)->nullable();
            $table->string('linha_digitavel', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
