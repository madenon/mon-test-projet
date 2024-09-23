<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
       // dd($comments); // Affiche le contenu de $comments et arrête l'exécution.
        return view('page-details', compact('comments'));
    }
    
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        // Créer un nouveau commentaire
        Comment::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
        ]);

        // Rediriger vers la même page après soumission
        return redirect()->route('comments.index')->with('success', 'Commentaire ajouté avec succès!');
    }
}
