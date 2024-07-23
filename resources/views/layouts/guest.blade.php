<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen pt-6 sm:pt-0 ">
           <div class="absolute inset-0 flex items-center justify-center" style="background-image: url('/images/bg-login.svg');" aria-label="Image de fond">
                <div class="w-[45%] login-div px-12 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
                
                <div class="footer-login text-xs">
                    <div class="absolute bottom-4 left-4 partie-droite">
                        <p class="text-white">Faistroquer.fr © 2023. Design by SEOMANIAK</p>
                    </div>
                    <div class="absolute bottom-4 right-4 partie-gauche">
                        <p class="text-white">Politique de confidentialité |
                            {{ __('Conditions générales d\'utilisation') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
