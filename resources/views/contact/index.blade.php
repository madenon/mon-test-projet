<x-app-layout>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Add your other global styles here */

            /* Style for the form */
            .custom-form {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid var(--line-color);
                border-radius: 8px;
                margin-top: 50px;
                box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.15);
            }

            /* Style for form inputs */
            .form-group {
                margin-bottom: 20px;
            }

            /* Style for the primary button */
            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                width: 100%;
            }

            .btn-primary:hover {
                background-color: var(--primary-color-hover);
                border-color: var(--primary-color-hover);
            }

            /* Style for the social media section */
            .social-section {
                margin-top: 20px;
            }

            .circle_social {
                display: inline-block;
                margin-right: 10px;
                border-radius: 50%;
                padding: 10px;
                text-decoration: none;
                color: #ffaa00;
            }

            /* Additional styles for the social media icons */
            .fa-stack {
                font-size: 24px;
            }
        </style>
        <title>Your Page Title</title>
    </head>
    <body>

        <!-- Your header and other content here -->
        <h1 class="text1 text-dark text-center mt-4" >CONTACTEZ-NOUS</h1>

        <div class="container">
            <form class="custom-form" method="post" action="{{ route('contact.send') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer nous un message</button>
            </form>

            <!-- Social media section -->
            <div class="d-flex flex-column align-items-center mt-4">
    <h1 class="text1 text-dark">SUIVEZ NOUS</h1>
    <div class="separator small center"></div>
    <h5>Suivez nous sur les réseaux sociaux et soyez à la une de toutes nos promotions.</h5>
    <div class="d-flex justify-content-center">
        <a class="circle_social" href="https://www.facebook.com/fraistroquer.fr/" target="_blank">
            <span class="fa-stack">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <a class="circle_social" href="https://www.instagram.com/?hl=fr" target="_blank">
            <span class="fa-stack">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <a class="circle_social" href="https://www.youtube.com/channel/UCAPv8iQcz4dmhZfHUizP46Q/videos" target="_blank">
            <span class="fa-stack">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
            </span>
        </a>
    </div>
</div>

        </div>

    </body>
    </html>
</x-app-layout>
