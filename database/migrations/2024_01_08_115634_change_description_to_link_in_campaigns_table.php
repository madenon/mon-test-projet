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
        // Step 1: Make the 'description' column nullable
        Schema::table('campaigns', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        // Step 2: Rename the 'description' column to 'link'
        Schema::table('campaigns', function (Blueprint $table) {
            $table->renameColumn('description', 'link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            //
        });
    }
};
