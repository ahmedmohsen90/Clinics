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
        Schema::create('insurance_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->index();
            $table->foreignId('insurance_company_id')->index();
            $table->integer("insurance_number");
            $table->integer("company_percentage");
            $table->integer("national_id")->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_customers');
    }
};
