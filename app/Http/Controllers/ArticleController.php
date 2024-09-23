<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'contenu' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $article = new Article();
        $article->titre = $request->input('titre');
        $article->auteur = $request->input('auteur');
        $article->categorie = $request->input('categorie');
        $article->contenu = $request->input('contenu');
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $article->photo = $photoPath; // Enregistre le chemin complet
        }
    
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }
        public function index()
    {
        $articles = Article::all();
        //dd($articles); // This will dump the data and stop execution
        return view('articles.index', compact('articles'));
    }
    

    
}

