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
        Schema::table('ch_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('from_id')->change();
            $table->unsignedBigInteger('to_id')->change();

            $table->foreign('from_id')->references('id')->on('users');
            $table->foreign('to_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ch_messages', function (Blueprint $table) {
            $table->dropForeign(['from_id']);
            $table->dropForeign(['to_id']);


            // $table->bigInteger('from_id')->change();
            // $table->bigInteger('to_id')->change();
        });
    }
};
