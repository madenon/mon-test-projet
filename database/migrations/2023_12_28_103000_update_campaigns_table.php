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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('banner')->nullable()->after('sponsor_id');
            $table->string('page')->after('banner');
            $table->string('position')->after('page');
            $table->dateTime('start_date')->change();
            $table->dateTime('end_date')->change();
            $table->boolean('is_active')->default(false);
            $table->string('timezone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('banner');
            $table->dropColumn('page');
            $table->dropColumn('position');
        });
    }
};
