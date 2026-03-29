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
        Schema::create('case_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_company_id')->index();
            $table->foreignId('customer_case_id')->index();
            $table->double("percent", 8, 3)->default(0);
            $table->double("amount", 8, 3)->default(0);
            $table->timestamps();
            $table->foreign('customer_case_id')->references('id')->on('customer_cases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_insurances');
    }
};
