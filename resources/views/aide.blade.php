<!-- resources/views/aide.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Aide</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        .faq {
            margin-top: 20px;
        }
        .faq-item {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .faq-question {
            font-weight: bold;
            color: #007bff;
        }
        .faq-answer {
            margin-top: 5px;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Page d'Aide</h1>
        <p>Bienvenue sur la page d'aide de notre site. Ici, vous trouverez des réponses aux questions les plus fréquemment posées.</p>

        <div class="faq">
            <div class="faq-item">
                <div class="faq-question">1. Comment puis-je créer un compte ?</div>
                <div class="faq-answer">Pour créer un compte, cliquez sur "S'inscrire" en haut à droite de la page d'accueil, puis suivez les instructions.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. Comment réinitialiser mon mot de passe ?</div>
                <div class="faq-answer">Cliquez sur "Mot de passe oublié" sur la page de connexion, puis suivez les instructions pour réinitialiser votre mot de passe.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. Comment puis-je contacter le support technique ?</div>
                <div class="faq-answer">Vous pouvez nous contacter via le formulaire de contact disponible sur la page "Contact" ou en envoyant un email à support@votre-site.com.</div>
            </div>
        </div>
    </div>
</body>
</html>
