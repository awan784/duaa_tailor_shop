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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('tailor_id')->nullable();
            $table->date('date')->nullable();
            $table->string('bill_no')->nullable();
            $table->enum('status', ['Inprocessing', 'Completed'])->default('Inprocessing');
            $table->text('products')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('labour_cost')->nullable();
            $table->string('discount')->nullable();
            $table->string('net_total')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
