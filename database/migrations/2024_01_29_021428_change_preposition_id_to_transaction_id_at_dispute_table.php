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
        Schema::table('disputes', function (Blueprint $table) {
            $table->dropForeign(['preposition_id']);
            $table->dropColumn(['preposition_id']);
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disputes', function (Blueprint $table) {
            $table->unsignedBigInteger('preposition_id')->nullable();
            $table->foreign('preposition_id')
                ->references('id')
                ->on('prepositions');
            $table->dropForeign(['transaction_id']);
            $table->dropColumn(['transaction_id']);
    
        });
    }
};
