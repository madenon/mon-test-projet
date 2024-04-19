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
        Schema::table('transactions', function (Blueprint $table) {
            // Remove 'status' column
            $table->dropColumn('status');

            // Add 'offeror_status' and 'applicant_status' columns
            $table->string('offeror_status')->nullable();
            $table->string('applicant_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->string('status');
            $table->dropColumn('offeror_status');
            $table->dropColumn('applicant_status');
        });
    }
};
