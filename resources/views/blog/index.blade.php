<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Troc de Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        h1::after {
            content: '';
            width: 80px;
            height: 3px;
            background-color: #3498db;
            display: block;
            margin: 10px auto 0;
        }

        .article-meta {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-align: center;
        }

        .content {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: justify;
            color: #34495e;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .comments {
            margin-top: 30px;
            padding: 15px;
            background-color: #ecf0f1;
            border-radius: 8px;
        }

        .comments h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2980b9;
        }

        .comments p {
            margin-bottom: 10px;
            color: #7f8c8d;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .icon {
            display: inline-flex;
            align-items: center;
            margin-right: 10px;
            color: #3498db;
        }

        .icon i {
            margin-right: 5px;
        }
        .container {
    background-color: #ffffff;
    margin: 20px auto;
    padding: 20px;
    max-width: 800px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
    </style>
    <!-- Lien vers FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="{{ asset('images/haa.jpg') }}" alt="Image représentant le troc de services">
        </div>

        <h1><i class="fas fa-handshake icon"></i> Le Troc de Services : une astuce à adopter</h1>

        <div class="article-meta">
            <i class="fas fa-calendar-alt icon"></i> 10-07-2021 |
            <i class="fas fa-user icon"></i> Sandra Novelli |
            <i class="fas fa-comments icon"></i> 4 commentaires
        </div>

        <div class="content">
            <p>Parfois, on manque de temps ou de compétences spécifiques pour exécuter certaines tâches. Qu’il s’agisse de s’atteler au travail administratif, de faire du bricolage, d’entretenir son site web ou encore de cueillir les cerises de l’arbre du jardin…</p>
        </div>

        <a href="{{ url('/page-details') }}" class="btn">Lire la suite</a>

    </div>
    <div class="article-container">
    <div class="image-container">
        <img src="{{ asset('images/kaw.jpg') }}" alt="Image représentant les vacances et le troc de maison">
    </div>
    <h1 class="article-title">Troc Maison : partir en vacances sans se ruiner 🌴</h1>
    <div class="article-meta">
        <i class="fas fa-calendar-alt icon"></i> 04-06-2021 |
        <i class="fas fa-user icon"></i> Sandra Novelli |
        <i class="fas fa-comments icon"></i> 0 Commentaire
    </div>
    <div class="content">
        <p>Vous rêvez de voyager à peu de frais ? Naturellement ! Qui ne le souhaiterait pas ? Eh bien, ça tombe bien, nous avons une solution pour vous. Généralement, pourquoi les vacances coûtent-elles si cher ? Qu’est-ce qui occasionne le plus de dépenses ? Le logement…</p>
        <p>À moins de camper, sous tente et non en chalet de camping, le portefeuille a vite fait de faire la grimace après une ou trois semaines de séjour… On vous raconte comment se loger gratuitement en…</p>
    </div>
    <a href="/" class="btn">Lire la suite</a>
</div>
<div class="article-container">
    <div class="image-container">
        <img src="{{ asset('images/velo.jpg') }}"  alt="Image représentant un vélo">
    </div>
    <h1 class="article-title">🚲 Le Troc Vélo, on s’y met ?</h1>
    <div class="article-meta">
        <span><i class="fas fa-calendar-alt icon"></i> 18-04-2021</span>
        <span><i class="fas fa-user icon"></i> Sandra Novelli</span>
        <span><i class="fas fa-comments icon"></i> 0 Commentaire</span>
    </div>
    <div class="content">
        <p>Quel est le moyen de transport individuel le plus pratique et le plus écologique à la fois ? Celui qui vous rend autonome et se faufile agilement entre les interminables files de voitures ? Le vélo, bien entendu ! Les beaux jours sont de retour, c’est le moment idéal pour se procurer cet accessoire si agréable d’utilisation.</p>
        <p>Vous cherchez un nouveau vélo pas cher voire gratuit ? Nous avons la solution ! On vous explique tout sur le troc vélo. Comment trouver un vélo d’occasion ?…</p>
    </div>
    <a href="/" class="btn">Lire la suite</a>
</div>
<div class="article-container">
    <div class="image-container">
        <img src="{{ url('images/donne.jpg') }}" alt="Image représentant le don d'objets">
    </div>
    <h1 class="article-title">Donner Ses Affaires, ça fait du bien !</h1>
    <div class="article-meta">
        <span><i class="fas fa-calendar-alt icon"></i> 30-08-2020</span>
        <span><i class="fas fa-user icon"></i> Sandra Novelli</span>
        <span><i class="fas fa-comments icon"></i> 2 commentaires</span>
    </div>
    <div class="content">
        <p>Quand on se retrouve encombré par des objets dont on n’a plus l’utilité, on songe généralement à les revendre… Mais on peut tout aussi bien en faire don ! Pourquoi donner ses affaires ? Où trouver des receveurs intéressés ? Aujourd’hui, on vous explique tout sur cet acte de gentillesse et de solidarité !</p>
        <p>L’un des avantages immédiats dans le fait de donner ses affaires, c’est la certitude de leur trouver un nouveau propriétaire. Un objet mis…</p>
    </div>
    <a href="" class="btn">Lire la suite</a>
</div>
<div class="article-container">
    <div class="image-container">
        <img src="{{ url('images/main.jpg') }}" alt="Image représentant le don d'objets">
    </div>
    <h1 class="article-title">Êtes-Vous Plutôt TROC ou VENTE ?</h1>
    <div class="article-meta">
        <span><i class="fas fa-calendar-alt icon"></i> 30-08-2020</span>
        <span><i class="fas fa-user icon"></i> Sandra Novelli</span>
        <span><i class="fas fa-comments icon"></i> 2 commentaires</span>
    </div>
    <div class="content">
        <p>Pour pouvoir consommer avec un petit budget, deux solutions majeures existent : le troc ou la vente. Laquelle des deux préférez-vous ? Quels sont les avantages de l’un et de l’autre ? Leurs intérêts respectifs peuvent varier en fonction de vos besoins. Mais sur certains aspects, ils se </p>
        <p>rejoignent… Faisons le point sur ces deux modes de consommation alternatifs !   Le troc et la vente présentent des avantages communs   Lorsque les affaires commencent à s’amasser dans le garage, dans le grenier ou…

</p>
    </div>
    <a href="" class="btn">Lire la suite</a>
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
<style>
    /* Style pour le conteneur de l'article */
.article-container {
    background-color: #ffffff;
    margin: 20px auto;
    padding: 20px;
    max-width: 800px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Style pour l'image de l'article */
.image-container {
    text-align: center;
    margin-bottom: 20px;
}

.image-container img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style pour le titre de l'article */
.article-title {
    font-size: 24px;
    color: #333333;
    margin-bottom: 10px;
    text-align: center;
}

/* Style pour les métadonnées de l'article */
.article-meta {
    font-size: 14px;
    color: #777777;
    margin-bottom: 20px;
    text-align: center;
}

.article-meta .icon {
    color: #ff9800; /* Couleur des icônes */
    margin-right: 5px;
}

/* Style pour le contenu de l'article */
.content {
    font-size: 16px;
    color: #555555;
    line-height: 1.6;
    margin-bottom: 20px;
    padding: 0 20px;
    text-align: justify;
}

/* Style pour le bouton "Voir plus" */
.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #ffffff;
    background-color: #3498db;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2980b9;
}
footer {
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

</style>
