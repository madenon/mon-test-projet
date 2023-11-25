<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->boolean('name');
            $table->boolean('description')->nullable();
            $table->boolean('exchange_state')->nullable();
            $table->enum('experience', ['NO_EXPERIENCE', 'LESS_THAN_5_YEARS', 'BETWEEN_5_AND_10_YEARS', 'BETWEEN_10_AND_25_YEARS', 'MORE_THAN_25_YEARS']);
            $table->boolean('offer_default_photo');
            $table->boolean('slug');
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
