<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offer->title }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="offre-page mx-9">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>
    @php
    $conditionMapping = [
    'NEW' => 'Neuf',
    'VERY_GOOD' => 'Très bon état',
    'GOOD' => 'Bon état',
    'MEDIUM' => 'Etat moyen',
    'BAD' => 'Mauvais état',
    'BROKEN' => 'En panne',
    ];
    @endphp
    <div class="flex gap-5 offre-page">
        <div class="w-[50%] ml-12 partie-slide">
            <div class=" flex flex-col gap-6">
                <div class="">
                    <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}"
                        alt="Image principale" id="mainImage" class=" h-[450px] w-[750px] rounded-lg " />
                </div>
                <div class="flex scrollBar  gap-3 overflow-x-auto p-2 h-">
                    @foreach ($images as $img)
                        <img src="{{ route('offer-pictures-file-path',$img->offer_photo) }}" alt="Image produit"
                            class=" h-[80px] hover:cursor-pointer hover:scale-110 rounded-lg hover:transition-transform hover:transform-gpu "
                            onmouseover="changeMainImage('{{ $img->offer_photo }}')"
                            onmouseout="changeMainImage('{{ $offer->offer_default_photo }}')" />
                    @endforeach
                </div>
            </div>
            <div class="my-5">
                <div class="my-3">
                    <h2 class="text-titles ">Description</h2>
                    <p>{{ $offer->description }}</p>
                </div>
                <div id="map" class=" mt-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5916333.136450014!2d-1.3992720794176445!3d43.60998660794066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6af0725dd9db1%3A0xad8756742894e802!2sMontpellier%2C%20France!5e0!3m2!1sfr!2sma!4v1697796341376!5m2!1sfr!2sma"
                        class="h-[400px] w-[100%]" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="w-[38%] partie-detail">
            <h2 class="text-titles  font-semibold">{{ $offer->title }}</h2>
            <button
                class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover "
                type="submit">
                {{ __('Troquez Maintenant ') }}
            </button>
            <div class="border pt-4 flex rounded-lg flex-col ">
                <div class="flex pb-3 px-12 gap-2 flex-col ">
                    <div class="flex  items-center   ">
                        <span class="w-[35%]">
                            Type de troc:
                        </span>
                        <span class="text-titles text-lg ">
                            {{$offer->type->name }}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Categorie:
                        </span>
                        <span class="text-titles text-lg flex items-center div-categorie">
                            <img src="/images/Stack.svg" alt="" class="mr-2">
                            {{$offer->category->name}}
                            <img src="/images/chevron-right.svg" alt="" class="px-2">
                            {{$subcategory->name}}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Mis en ligne le:
                        </span>
                        <span class="text-titles text-lg flex ">
                            {{ $offer->user->created_at->format('d M Y | H:i:s') }}
                        </span>
                    </div>
                </div>
                @if($offer->condition)
                <div class=" border-y py-3 ">
                    <div class=" px-12 flex    items-center">
                        <span class="w-[35%]">
                            L’etat:
                        </span>
                        <span class="text-titles text-lg flex gap-2 ">
                            &#128578;
                            <p>{{ $conditionMapping[$offer->condition] }}</p>
                        </span>
                    </div>
                </div>
                @endif
                <div class="border-b py-3">
                    <div class="px-12 flex   gap-2 items-center">
                        <img src="/images/map-pin.svg" alt="">
                        <span class="">
                            {{$offer->region->name . ", " .
                            $offer->department->name}}
                        </span>
                    </div>
                </div>
                <div class=" pt-3">
                    <div class="px-12 flex justify-content-between  gap-2 items-center">
                        @if($offer->price)
                        <span class="text-titles text-2xl font-semibold">
                            {{$offer->price}} €
                        </span>
                        @endif
                        <span class="flex bg-red-100  rounded-full px-3 py-1 gap-2 text-red-500">
                            <span class="bg-red-500 px-2 rounded-full text-white">$</span>
                            <span>Vente autorisé</span>
                        </span>
                    </div>
                    <div class="m-4 bg-gray-100 p-4 rounded-lg">
                        <h5>À ÉCHANGER CONTRE :</h5>
                        <span class="flex gap-2 px-5">
                            <img src="/images/Icon.svg" alt="">
                            <span>
                                Etudie toute proposition
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class=" my-4  justify-center border-black py-2 border-b rounded-lg flex gap-2 w-52">
                <img src="/images/flag_FILL0_wght200_GRAD-25_opsz20 1.svg" alt="">
                <span>
                    Signalez ce troc
                </span>
            </div>
            <div class="border rounded-lg pb-4">
                <h4 class="text-titles border-b px-5 py-4">Vendeur</h4>
                <div>
                    <div class="flex justify-between px-4 py-2">
                        <div class="flex gap-3  ">
                            @if (!$offer->user->profile_photo_path)
                            <img src="/images/user-avatar-icon.svg" alt="Avatar">
                            @else
                            <img class="w-12 h-12 rounded-full" src="{{ route('profile_pictures-file-path',$offer->user->profile_photo_path) }}" alt=""
                                class="rounded-full">
                            @endif
                            <span class="flex flex-col">
                                <span class="text-titles font-medium">
                                    {{$offer->user->first_name . " " .
                                    $offer->user->last_name}}
                                </span>
                                @if ($offer->user->is_online=="Offline")
                                <span class="text-red-500">Hors ligne</span>
                                @else
                                <span class="text-green-500">En ligne</span>
                                @endif
                            </span>
                            <img src="/images/Badge-pro.svg" alt="" class="pb-3 ">
                        </div>
                        <div class="flex flex-col ">
                            <span>
                                4/5 (6 avis)
                            </span>
                            <span class="flex">
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-gray-200"></i>
                            </span>
                        </div>
                    </div>
                    <div class="m-4 flex gap-4 justify-content-between">
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Trocs
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Offres
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Avis
                        </div>
                    </div>
                    <div class=" flex px-3 gap-4">
                        <button
                            class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover">
                            Voir Profil
                        </button>
                        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-black ">
                            Contact
                        </button>
                    </div>
                </div>
            </div>
            <div class="m-auto mt-5 w-[60%]  ">
                <h5 class="mb-4">
                    Partager cette annonce à vos amis
                </h5>
                <div class=" flex justify-content-between ">
                    <a href="#"><i
                            class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i></a>
                    <a href="#">
                        <i
                            class="fa-brands fa-twitter text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="#">
                        <i
                            class="fa-brands fa-instagram text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="#"><i
                            class="fa-brands fa-youtube text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i></a>
                    <a href="#"><i
                            class="fa-brands fa-linkedin text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i></a>
                    <a href="#"><i
                            class="fa-brands fa-whatsapp text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
    <section class="similarOffers">
        <div class="flex justify-between px-24">
            <h1 class="mb-6 ml-12 font-sans text-2xl font-bold text-gray-900">Offres similaire</h1>
            <button class="bg-primary-color hover:bg-primary-hover mr-12 text-white font-bold py-2 px-4 rounded-2"><a class="no-underline font-medium text-white" href="#">Voir plus</a></button>
        </div>
        <div class="mx-auto grid max-w-screen-xl grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($similaroffers as $similar)
                        <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl " >
                            <a class="no-underline" href="{{route('offer.offer', [$similar->id, $similar->slug])}}">
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img class="w-full h-96" src="{{ route('offer-pictures-file-path',$similar->offer_default_photo)}}" alt="Offer Photo" />
                                </div>
                                <div class="mt-1 p-2">
                                    <span class="text-gray-500 text-lg flex items-center div-categorie pb-2">
                                        <img src="/images/Stack.svg" alt="" class="mr-2 ">
                                        {{$similar->category->name}}
                                    </span>
                                    <span class="text-titles font-bold text-3xl overflow-hidden">
                                        {{$similar->title }}
                                    </span>
                                    <hr class="w-full text-titles">
                                    <div class="mt-3 flex items-end justify-between">
                                        <div class="flex gap-2 items-center">
                                            <img src="/images/map-pin.svg" alt="">
                                            <span class="text-gray-500">
                                                {{$similar->region->name . ", " .
                                                $similar->department->name}}
                                            </span>
                                        </div>
                                        <div class="group inline-flex rounded-xl">
                                            <span class="text-red-500 text-lg">
                                                {{$similar->type->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                @endforeach
        </div>
    </section>


    <script>
        function changeMainImage(newImage) {
            const mainImage = document.getElementById('mainImage');
                mainImage.src = window.location.origin +'/file/offer-pictures/'+newImage;
        }
    </script>
        
</x-app-layout>
