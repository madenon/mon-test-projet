<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Ajoute les attributs que tu souhaites remplir en masse
    protected $fillable = [
        'titre',
        'auteur',
        'categorie',
        'contenu',
        'image', // Assurez-vous d'inclure le champ image
    ];
}
