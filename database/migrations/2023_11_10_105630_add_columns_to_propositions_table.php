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
            $table->string('status')->nullable();
            $table->text('negotiation')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prepositions', function (Blueprint $table) {
            //
        });
    }
};
