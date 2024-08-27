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
            margin: 20px;
            padding: 0;
            color: #333;
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
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
        }

        .comments {
            margin-top: 30px;
            font-size: 16px;
            background-color: #ecf0f1;
            padding: 15px;
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

        .icon {
            display: inline-flex;
            align-items: center;
            margin-right: 10px;
            color: #3498db;
        }

        .icon i {
            margin-right: 5px;
        }
    </style>
    <!-- Ajouter le lien vers FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

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
        <p>Parfois, on manque de temps ou de compétences spécifiques pour exécuter certaines tâches. Qu’il s’agisse de s’atteler au travail administratif, de faire du bricolage, d’entretenir son site web ou encore de cueillir les cerises de l’arbre du jardin… nous avons tous nos bêtes noires en termes de corvées, et au contraire, aucune gêne voire des facilités à en exécuter d’autres. Et puis, bien entendu, le problème peut aussi être d’ordre financier. Faire appel à un prestataire de services peut coûter…</p>
    </div>
    <div class="content">
    <p>Parfois, on manque de temps ou de compétences spécifiques pour exécuter certaines tâches...</p>

    <!-- Bouton Voir plus -->

    <a href="{{ url('/page-details') }}"  id="seeMoreBtn" class="btn">Voir plus</a>
</div>
</body>
<style>
    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #2980b9;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #3498db;
    }
</style>

</html>
