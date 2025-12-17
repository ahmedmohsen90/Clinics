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
        Schema::create('customer_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')->index();
            $table->foreignId('doctor_id')->index();
            $table->foreignId('customer_id')->index();
            $table->double("amount", 8, 3)->default(0);
            $table->text("note")->nullable();
            $table->timestamps();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_cases');
    }
};
