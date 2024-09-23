<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function index()
    {
        $posts = [
            ['title' => 'Titre de l\'article 1', 'excerpt' => 'Un court résumé ou extrait de l\'article 1...', 'image' => 'https://via.placeholder.com/300x200'],
            ['title' => 'Titre de l\'article 2', 'excerpt' => 'Un court résumé ou extrait de l\'article 2...', 'image' => 'https://via.placeholder.com/300x200'],
            // Ajoutez plus d'articles ici
        ];
        return view('blog.index', compact('posts'));
    }
    public function show()
{
    // Remplacez cela par votre logique pour récupérer les commentaires
    $comments = Comment::all(); 

    // Passez les commentaires à la vue
    return view('page-details', compact('comments'));
}
}
