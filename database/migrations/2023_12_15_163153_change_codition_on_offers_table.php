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

        Schema::table('offers', function (Blueprint $table) {

            $table->dropColumn('condition');
  
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->enum('condition', ['NEW', 'VERY_GOOD', 'GOOD', 'MEDIUM', 'BAD', 'BROKEN'])
                ->default('NEW');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::table('offers', function (Blueprint $table) {

            $table->string('condition')->nullable();
        });
    }
};
