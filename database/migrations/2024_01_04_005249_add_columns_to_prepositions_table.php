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
            $table->boolean('freezed')->default(false);
            $table->boolean('appealed')->default(false);
            $table->unsignedBigInteger('appealer_id')->nullable();
            
            $table->foreign('appealer_id')->references('id')->on('users');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prepositions', function (Blueprint $table) {
            $table->dropForeign(['appealer_id']);
            $table->dropColumn(['freezed', 'appealed', 'appealer_id']);
        });
    }
};
