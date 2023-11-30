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
            $table->unsignedBigInteger('chat_id')->default(1);

            $table->foreign('chat_id')->references('id')->on('chats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prepositions', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['chat_id']);
            
            // Remove the column
            $table->dropColumn('chat_id');
        });
    }
};
