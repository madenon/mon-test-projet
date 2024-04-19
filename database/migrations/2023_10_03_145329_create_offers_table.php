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
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('exchange_state')->nullable();
            $table->enum('experience', ['NO_EXPERIENCE', 'LESS_THAN_5_YEARS', 'BETWEEN_5_AND_10_YEARS', 'BETWEEN_10_AND_25_YEARS', 'MORE_THAN_25_YEARS']);
            $table->string('offer_default_photo');
            $table->string('slug');
            $table->string('countdown')->default(false);
            $table->string('countdownTo')->nullable();
            $table->string('active_offer')->default(true);
            $table->string('archive_offer')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('buy_authorized')->default(false);
            $table->string('send_authorized')->default(false);
            $table->float('price')->nullable();
            $table->string('perimeter_authorized')->default(false);
            $table->integer('perimeter')->nullable();
            $table->string('specify_proposition')->default(false);
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
