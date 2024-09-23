<x-app-layout>
<style>
                                        @keyframes revealText {
                                            0% {
                                                width: 0;
                                            }
                                            100% {
                                                width: 100%;
                                            }
                                        }

                                        .reveal-container {
                                            display: flex;
                                            align-items: center;
                                            justify-content: start;
                                        }
                                        
                                        .reveal-text {
                                            display: inline-block;
                                            animation: revealText 3s steps(13, end) forwards;
                                            overflow: hidden;
                                            white-space: nowrap;
                                        }
                                    </style>

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Annonce publiée avec succès !</h1>
            <p class="lead">Votre annonce a été publiée avec succès.</p>
            <hr class="my-4">
            <div class="reveal-container">
                <p class="reveal-text text-xl">Que souhaitez-vous faire ensuite ?</p>
            </div>

            <div id="buttonContainer"  class="flex justify-start gap-2 hidden">
                <button id="prevBtn" class="text-white rounded-md w-60 h-12 flex justify-center items-center bg-gray-900  hover:bg-black"
                    type="button">
                    <a class="no-underline font-medium text-white " href="{{route('offer.create')}}">Publier une autre annonce </a>
                </button>
                <button id="nextBtn" class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-primary-color hover:bg-primary-hover"
                type="button">
                <a class="no-underline font-medium text-white " href="{{ route('offer.offer', ['offerId'=>$offerId, 'slug'=>$slug]) }}">Voir l'annonce </a>
                </button>
            </div>

        </div>
    </div>
    
    
    <script>
        // Wait for the document to load
        document.addEventListener('DOMContentLoaded', function () {
            // Delay showing buttons after 3 seconds
            setTimeout(function () {
                // Remove the class that hides the buttons
                document.getElementById('buttonContainer').classList.remove('hidden');
            }, 1500); // 3000 milliseconds = 3 seconds
        });
    </script>

</x-app-layout>
