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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('tenant_id')->index()->constrained();
            $table->string('descricao', 100);
            $table->string('conta', 20);
            $table->string('conta_dv', 2);
            $table->string('agencia', 20);
            $table->string('agencia_dv', 2);
            $table->string('variacao_carteira', 5);
            $table->string('convenio', 20);
            $table->string('multa', 20);
            $table->string('juros', 20);
            $table->string('desconto', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
