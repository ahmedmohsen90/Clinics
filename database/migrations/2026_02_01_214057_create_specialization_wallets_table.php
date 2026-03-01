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
        Schema::create('specialization_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')->index();
            $table->foreignId('wallet_id')->index();
            $table->timestamps();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialization_wallets');
    }
};
