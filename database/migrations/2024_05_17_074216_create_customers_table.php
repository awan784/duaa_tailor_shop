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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('neck')->nullable();
            $table->string('shoulders')->nullable();
            $table->string('sleeve_length')->nullable();
            $table->string('length')->nullable();
            $table->string('sleeve_opening')->nullable();
            $table->string('chest')->nullable();
            $table->string('waist')->nullable();
            $table->string('hips')->nullable();
            $table->string('Asaan')->nullable();
            $table->string('Thighs')->nullable();
            $table->string('bottom_length')->nullable();
            $table->string('mori')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
