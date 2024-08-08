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
        Schema::table('availabilities', function (Blueprint $table) {
            // Drop the existing foreign key and column
            $table->dropForeign(['proposition_id']);
            $table->dropColumn('proposition_id');

            // Add the new foreign key and column
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('availabilities', function (Blueprint $table) {
            // Drop the new foreign key and column
            $table->dropForeign(['offer_id']);
            $table->dropColumn('offer_id');

            // Add the old foreign key and column back
            $table->foreignId('proposition_id')->constrained('propositions')->onDelete('cascade');
        });
    }
};
