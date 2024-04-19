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
            $table->dropForeign('offers_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropForeign('offers_region_id_foreign');
            $table->dropColumn('region_id');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // $table->foreignId('category_id')->constrained()->onUpdate('cascade');
            // $table->foreignId('region_id')->constrained()->onUpdate('cascade');
        });
        //
    }
};
