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
        Schema::create('payment_method_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->index();
            $table->double('amount', 8, 3);
            $table->enum('operation', ['plus', 'minus'])->default('plus');
            $table->string("description")->nullable();
            $table->timestamps();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_method_transactions');
    }
};
