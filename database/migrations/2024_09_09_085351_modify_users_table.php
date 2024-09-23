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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter une nouvelle colonne
            $table->string('nouvelle_colonne')->nullable();

            // Modifier une colonne existante
            $table->boolean('active')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la colonne ajoutée
            $table->dropColumn('nouvelle_colonne');

            // Revenir à l'état précédent de la colonne modifiée
            $table->string('active')->change();
        });
    }
};
