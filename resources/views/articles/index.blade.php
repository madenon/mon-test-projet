<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</head>
<body>

<h1>Liste des Articles</h1>

<a href="{{ route('articles.create') }}">Créer un nouvel article</a>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
            <tr>
                <td>
                <td>
    @if($article->photo)
        <img src="{{ asset('storage/' . $article->photo) }}" alt="Image de {{ $article->titre }}" style="max-width: 100px; height: auto;">
        <p>Chemin: {{ asset('storage/' . $article->photo) }}</p>
    @else
        <p>Aucune image</p>
    @endif
</td>
                </td>
                <td>{{ $article->titre }}</td>
                <td>{{ $article->auteur }}</td>
                <td>{{ $article->categorie }}</td>
                <td>
                    <a href="{{ route('articles.show', $article->id) }}">Voir</a>
                    <a href="{{ route('articles.edit', $article->id) }}">Modifier</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
