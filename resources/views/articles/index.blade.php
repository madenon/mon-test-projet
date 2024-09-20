<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        .articles {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .article-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            width: 550px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .article-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .article-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .article-content {
            padding: 20px;
            text-align: center;
        }

        .article-title {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .article-paragraph {
    font-size: 16px; /* Taille de la police */
    color: #666; /* Couleur du texte */
    margin-bottom: 15px; /* Espacement en bas */
    line-height: 1.6; /* Hauteur de ligne pour une meilleure lisibilité */
    text-align: left; /* Alignement à gauche */
    overflow-wrap: break-word; /* Pour éviter que le texte déborde */
    max-height: 80px; /* Limite de hauteur pour le paragraphe */
    overflow: hidden; /* Cache le texte qui dépasse */
    /* Affiche des points de suspension pour le texte coupé */
}

.article-paragraph:hover {
    max-height: none; /* Affiche tout le texte au survol */
}


        .article-content a {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .article-content a:hover {
            background-color: #218838;
        }

        .article-content form button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .article-content form button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="articles">
    @foreach($articles as $article)
        <div class="article-container">
            <div>
                @if($article->photo)
                    <img src="{{ asset('storage/' . $article->photo) }}" alt="Image de {{ $article->titre }}" class="article-image">
                @else
                    <p>Aucune image disponible</p>
                @endif
            </div>
            <div class="article-content">
                <div class="article-title">{{ $article->titre }}</div>
                <div class="article-paragraph">{{ Str::limit($article->contenu, 100000) }}</div>
                <a href="{{ route('articles.show', $article->id) }}">Voir plus</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
