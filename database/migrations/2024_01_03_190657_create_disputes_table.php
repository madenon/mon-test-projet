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
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('disputer_id');
            $table->unsignedBigInteger('preposition_id');
            $table->boolean('isOpen')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();        
            
            $table->foreign('disputer_id')->references('id')->on('users');
            $table->foreign('preposition_id')->references('id')->on('prepositions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disputes');
    }
};
