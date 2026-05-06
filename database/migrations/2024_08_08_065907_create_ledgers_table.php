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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('total_price')->nullable();
            $table->integer('customer_id')->nullable();
            $table->enum('customer_type', ['customer', 'tailor'])->nullable();
            $table->enum('transaction_type', ['debit', 'credit'])->nullable();
            $table->integer('sale_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
