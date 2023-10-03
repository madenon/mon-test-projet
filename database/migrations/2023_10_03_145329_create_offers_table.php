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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('exchange_state')->nullable();
            $table->string('experience')->nullable();
            $table->string('offer_default_photo');
            $table->boolean('countdown')->default(false);
            $table->boolean('countdownTo')->nullable();
            $table->boolean('active_offer')->default(true);
            $table->boolean('archive_offer')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->boolean('buy_authorized')->default(false);
            $table->float('price')->nullable();
            $table->boolean('perimeter_authorized')->default(false);
            $table->integer('perimeter')->nullable();
            $table->boolean('specify_proposition')->default(false);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade');
            $table->foreignId('region_id')->constrained()->onUpdate('cascade');
            $table->foreignId('department_id')->constrained()->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
