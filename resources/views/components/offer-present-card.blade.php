<article class="rounded-lg bg-white shadow hover:shadow-lg p-4 max-w-xs mx-auto">
    <div class="relative overflow-hidden rounded-lg">
        <img class="w-full h-48 object-cover" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo)}}" alt="Offer Photo" />
    </div>
    <a class="no-underline" href="{{route('offer.offer', [$offer->id, $offer->slug])}}">
        <div class="mt-2">
            <span class="text-gray-500 text-md flex items-center pb-1">
                <img src="/images/Stack.svg" alt="" class="mr-1">
                {{$offer->subcategory->parent->name}}
            </span>
            <span class="text-titles font-bold text-xl">
                {{Str::limit($offer->title, 15)}}
            </span>
            <hr class="w-full my-1 text-gray-300">
            <div class="mt-2 flex items-center justify-between">
                <div class="flex gap-1 items-center">
                    <img src="/images/map-pin.svg" alt="" class="w-4 h-4">
                    <span class="text-gray-500 text-sm">
                        {{Str::limit($offer->department->region->name . ", " . $offer->department->name, 10)}}
                    </span>
                </div>
                <div class="inline-flex rounded-full bg-gray-100 px-2 py-1">
                    <span class="text-lg text-teal-600 font-bold uppercase">
                        {{$offer->type->name}}
                    </span>
                </div>
            </div>
        </div>
    </a>
    <style>
        /* Ajouter ce style à ton fichier CSS */
        .offer-card {
    display: flex;
    flex-direction: column; /* Aligne les éléments verticalement */
    justify-content: space-between; /* Espacement uniforme entre les éléments */
    width: 100%; /* Largeur à 100% */
    max-width: 300px; /* Ajuste selon tes besoins */
    height: 400px; /* Hauteur fixe pour uniformité */
    border-radius: 12px; /* Coins arrondis */
    background-color: #ffffff; /* Couleur de fond */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
    transition: transform 0.2s, box-shadow 0.2s; /* Effets de transition */
    margin: auto; /* Centre les cartes dans le conteneur */
}

.offer-card:hover {
    transform: scale(1.02); /* Légère augmentation au survol */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); /* Ombre plus forte au survol */
}

.offer-card img {
    height: 180px; /* Hauteur fixe pour les images */
    width: 100%; /* Largeur à 100% */
    object-fit: cover; /* Ajustement de l'image */
}

.offer-card .content {
    padding: 1rem; /* Espacement intérieur */
    flex-grow: 1; /* Permet au contenu de remplir l'espace disponible */
}

.offer-card .text-titles {
    font-size: 1.25rem; /* Taille uniforme des titres */
    font-weight: bold; /* Gras */
}

.offer-card .text-gray-500 {
    font-size: 0.875rem; /* Taille uniforme pour le texte gris */
}

/* Espacement entre les éléments */
.offer-card .mt-2 {
    margin-top: 1rem;
}

.offer-card {
    ...
    max-width: 400px; /* Garde ça si nécessaire */
    overflow: hidden; /* Empêche le débordement */
}




    </style>
</article>
