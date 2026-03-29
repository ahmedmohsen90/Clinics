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
        Schema::create('customer_case_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_case_id')->index();
            $table->enum("status", ["pending", "start", "end", "cancel"])->default("pending");
            $table->enum("payment_status", ["pending", "paid", "unpaid", "refund", "cancel"])->default("pending");
            $table->timestamps();
            $table->foreign('customer_case_id')->references('id')->on('customer_cases')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_case_statuses');
    }
};
