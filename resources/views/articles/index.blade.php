=<!DOCTYPE html>
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
        }footer {
    background-color: #27ae60; /* Arrière-plan vert */
    color: #fff; /* Texte en blanc */
    padding: 20px 0;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-section {
    flex: 1;
    margin: 0 20px;
}

.footer-section h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #fff; /* Couleur des titres en blanc */
}

.footer-section p {
    font-size: 14px;
    line-height: 1.6;
}

.social-icons {
    margin-top: 15px;
}

.social-icons a {
    color: #fff; /* Couleur des icônes en blanc */
    margin-right: 10px;
    font-size: 18px;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #d1d8e0; /* Couleur au survol */
}

.contract-link {
    display: inline-block;
    margin-top: 15px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.contract-link:hover {
    color: #d1d8e0; /* Couleur au survol */
}

footer form {
    display: flex;
    flex-direction: column;
}

footer input[type="email"] {
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 14px;
}

footer button[type="submit"] {
    padding: 10px;
    background-color: #fff; /* Bouton blanc */
    color: #27ae60; /* Texte vert */
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

footer button[type="submit"]:hover {
    background-color: #d1d8e0; /* Changement de couleur au survol */
    color: #27ae60;
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
                    <img src="{{  url('storage/images/'.$article->photo) }}" alt="Image de {{ $article->titre }}" class="article-image">

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
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>QUI SOMMES NOUS ?</h3>
            <p>Faistroquer.fr, votre solution en ligne gratuite pour vous aider à échanger vos biens & services en toute confiance et simplicité.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <a href="#" class="contract-link">CONSULTEZ NOTRE CONTRAT D'ÉCHANGE >></a>
        </div>
        <div class="footer-section">
            <h3>NEWSLETTER</h3>
            <p>Inscrivez-vous à notre newsletter pour recevoir nos offres et nos promotions.</p>
            <form action="#">
                <input type="email" placeholder="Saisir votre email" required>
                <button type="submit">VALIDER</button>
            </form>
        </div>
    </div>


</footer>

</body>
</html>
