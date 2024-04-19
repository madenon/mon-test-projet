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
        Schema::table('prepositions', function (Blueprint $table) {
            $table->uuid('uuid')->default(DB::raw('(UUID())'));
            $table->enum('validation',['none','validated','confirmed'])->default('none');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prepositions', function (Blueprint $table) {
            $table->dropColumn(['uuid','validation']);
        });
    }
};
