<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide d'Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <div class="signup-guide">
        <h2>Créer un compte</h2>
        <div class="content-container">
            <ul class="steps-list">
                <li>
                    <input type="checkbox" id="step1" class="checkbox" checked>
                    <label for="step1">Créez un compte en cliquant sur le bouton <strong>S’inscrire</strong> visible au sommet de chaque page du site.</label>
                </li>
                <li>
                    <input type="checkbox" id="step2" class="checkbox" checked>
                    <label for="step2">Remplissez tous les champs.</label>
                </li>
                <li>
                    <input type="checkbox" id="step3" class="checkbox" checked>
                    <label for="step3">Téléversez votre photo de profil.</label>
                </li>
                <li>
                    <input type="checkbox" id="step4" class="checkbox" checked>
                    <label for="step4">Validez en cliquant sur le bouton <strong>Créer mon compte</strong> ou en appuyant sur la touche entrée de votre clavier.</label>
                </li>
                <li>
                    <input type="checkbox" id="step5" class="checkbox" checked>
                    <label for="step5">Vous recevrez ensuite un mail de confirmation. Cliquez alors sur le lien pour activer votre compte.</label>
                </li>
                <li>
                    <input type="checkbox" id="step6" class="checkbox" checked>
                    <label for="step6">Et c’est parti !</label>
                </li>
            </ul>
            <div class="video-container">
                <h3>Regardez la vidéo explicative</h3>
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/votre_video_id" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div><div class="trade-proposals">
  <h2>Recevez des propositions de troc</h2>
  <div class="content-container">
    <ul class="steps-list">
      <li>
        <input type="checkbox" id="step1" class="checkbox" checked>
        <label for="step1">Publiez votre annonce et attendez de recevoir des propositions d’autres membres du site.</label>
      </li>
      <li>
        <input type="checkbox" id="step2" class="checkbox" checked>
        <label for="step2">Choisissez l’option « Étudie toutes propositions » pour augmenter vos chances d’être contacté.</label>
      </li>
      <li>
        <input type="checkbox" id="step3" class="checkbox" checked>
        <label for="step3">Votre compte clignotera en orange à la réception d’une demande de soulte, d’un message, et/ou d’une proposition reçus de la part d’un membre.</label>
      </li>
      <li>
        <input type="checkbox" id="step4" class="checkbox" checked>
        <label for="step4">Consultez vos propositions reçues en cliquant sur le bouton vert « Voir les propositions » en face de l’une de vos annonces.</label>
      </li>
      <li>
        <input type="checkbox" id="step5" class="checkbox" checked>
        <label for="step5">Négociez avec les troqueurs qui vous contacteront et choisissez l’offre qui vous séduira le plus.</label>
      </li>
      <li>
        <input type="checkbox" id="step6" class="checkbox" checked>
        <label for="step6">Demandez une soulte si nécessaire et validez la proposition qui vous convient.</label>
      </li>
    </ul>
    <div class="video-container">
      <h3>Maximisez vos chances d’obtenir un troc</h3>
      <iframe src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>
<div class="trade-process">
  <h2>Terminez le processus de troc</h2>
  <p>Une fois que vous aurez choisi la proposition qui vous plaît le plus, contactez le membre qui l’a déposée. Vous déciderez avec elle des modalités d’échange et vous fixerez ensemble un rendez-vous pour procéder à la transaction (non-financière !).</p>
  <ul>
    <li>Recevez une proposition ;</li>
    <li>Validez celle qui vous intéresse le plus ;</li>
    <li>Contactez le troqueur pour fixer un rendez-vous.</li>
  </ul>
  <p>Une fois qu’un troc est validé par les deux parties, l’annonce disparaît automatiquement. Si toutefois l’accord a été passé par téléphone, veillez à supprimer votre annonce une fois la transaction terminée.</p>
  <p>Cliquez sur la <span class="delete-button">corbeille</span> supprimer dans la partie Mes trocs en cours de votre tableau de bord (page Mon compte).</p>
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
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 20px;
}

.signup-guide {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  max-width: 900px;
  margin: 0 auto;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
  font-size: 2rem;
  animation: slideFadeIn 1s ease-out forwards;
}

.content-container {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  padding: 20px;
}

.steps-list {
  list-style: none;
  padding: 0;
  margin: 0;
  max-width: 50%;
}

.steps-list li {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  position: relative;
  padding-left: 30px;
}

.checkbox {
  width: 20px;
  height: 20px;
  margin-right: 10px;
  accent-color: #008000;
  pointer-events: none;
}

.steps-list label {
  flex: 1;
  cursor: pointer;
}

.steps-list li::before {
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  font-size: 24px;
  color: #333;
  position: absolute;
  left: 0;
  top: 0;
  width: 24px;
  height: 24px;
  text-align: center;
  border-radius: 50%;
  background-color: #f7f7f7;
  padding: 4px;
}

.steps-list li:nth-child(1)::before {
  content: '\f007'; /* User icon */
}

.steps-list li:nth-child(2)::before {
  content: '\f15c'; /* Pencil icon */
}

.steps-list li:nth-child(3)::before {
  content: '\f1c5'; /* Camera icon */
}

.steps-list li:nth-child(4)::before {
  content: '\f0c5'; /* Checkmark icon */
}

.steps-list li:nth-child(5)::before {
  content: '\f0e0'; /* Envelope icon */
}

.steps-list li:nth-child(6)::before {
  content: '\f00c'; /* Smiley face icon */
}

.video-container {
  margin-left: 10px;
  max-width: 80%;
}

.video-wrapper {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
  max-width: 1300px;
  background-color: #000;
  border-radius: 8px;
}

.video-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}



.trade-proposals {
  max-width: 800px;
  margin: 40px auto;
  padding: 20px;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.content-container {
  padding: 20px;
}

.steps-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.steps-list li {
  margin-bottom: 20px;
}

.steps-list li input[type="checkbox"] {
  display: none;
}

.steps-list li label {
  display: block;
  padding: 10px;
  border-bottom: 1px solid #ccc;
  cursor: pointer;
}

.steps-list li label:before {
  content: "";
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-right: 10px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 50%;
  transition: background-color 0.2s ease;
}

.steps-list li input[type="checkbox"]:checked + label:before {
  background-color: #4CAF50;
}

.steps-list li label:hover {
  background-color: #f0f0f0;
}

.steps-list li label:active {
  background-color: #e0e0e0;
}

.video-container {
  margin-top: 40px;
}

.video-wrapper {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
}

.video-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* Animations */

.steps-list li {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.steps-list li:nth-child(1) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 0.5s;
}

.steps-list li:nth-child(2) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 1s;
}

.steps-list li:nth-child(3) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 1.5s;
}

.steps-list li:nth-child(4) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 2s;
}

.steps-list li:nth-child(5) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 2.5s;
}

.steps-list li:nth-child(6) {
  animation: fadeIn 0.5s ease forwards;
  animation-delay: 3s;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive design */

@media (max-width: 768px) {
  .trade-proposals {
    padding: 10px;
  }
  .content-container {
    padding: 10px;
  }
  .video-container {
    margin-top: 20px;
  }
  .video-wrapper {
    padding-bottom: 40%;
  }
}
footer {
    background-color: #008000;
    color: #fff;
    padding: 40px 0;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    padding: 0 50px;
}

.footer-section {
    max-width: 45%;
}

.footer-section h3 {
    color: whitesmoke; /* Primary color */
    font-size: 1.5em;
    margin-bottom: 20px;
}

.footer-section p {
    font-size: 1em;
    margin-bottom: 20px;
}

.social-icons a {
    display: inline-block;
    margin-right: 10px;
    font-size: 1.5em;
    color: #fff;
}

.contract-link {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.contract-link:hover {
    text-decoration: underline;
   
}

form {
    display: flex;
    flex-direction: column;
}

form input[type="email"] {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
}

form button {
    padding: 10px;
    background-color: transparent;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #008000;
    color: #000;
}

.footer-bottom {
    background-color: #111;
    text-align: center;
    padding: 20px;
    margin-top: 20px;
}

.footer-bottom p {
    margin: 5px 0;
}

.footer-bottom nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 5px;
    font-size: 0.9em;
}

.footer-bottom nav a:hover {
    text-decoration: underline;
}

.footer-bottom span {
    color: white;
}

  </style>