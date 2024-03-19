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
       // Drop the existing enum column
       Schema::table('meetups', function (Blueprint $table) {
        $table->dropColumn('status');
    });

    // Add the new varchar column with default value 'En cours'
    Schema::table('meetups', function (Blueprint $table) {
        $table->string('status')->default('En cours')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetups', function (Blueprint $table) {
            //
        });
    }
};
