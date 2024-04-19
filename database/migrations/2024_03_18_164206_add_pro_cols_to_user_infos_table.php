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
        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('social_reason')->nullable();
            $table->string('siren_number')->nullable();
            $table->string('company_identification_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn(['social_reason']);
            $table->dropColumn(['siren_number']);
            $table->dropColumn(['company_identification_document']);
        });
    }
};
