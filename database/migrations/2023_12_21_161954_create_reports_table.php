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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('offer_id');
            $table->boolean('isOpen')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('reporter_id')->references('id')->on('users');
            $table->foreign('offer_id')->references('id')->on('offers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
