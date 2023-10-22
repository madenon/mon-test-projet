<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offer->title }}
        </h2>
    </x-slot>


    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>


    
    <div class="flex gap-5 offre-page">
        <div class="w-[50%] ml-12 partie-slide">
            <div class=" flex flex-col gap-6">
                <div class="">
                    <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}"
                        alt="Image principale" id="mainImage" class="  rounded-lg " />
                </div>

                <div class="flex scrollBar  gap-3 overflow-x-auto  ">
                    @foreach ($images as $img)

                    <img src="{{ storage_path('/app/public/offer_pictures/'). $img->offer_photo}}" alt="Image produit"
                        class=" w-[15%] h-[50%] hover:cursor-pointer hover:scale-110 rounded-lg hover:transition-transform hover:transform-gpu"
                        onmouseover="changeMainImage('{{ $img->offer_photo }}')" />
                    @endforeach
                </div>
            </div>
            <div class="my-5">
                <div class="my-3">
                    <h2 class="text-black ">Description</h2>
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
            <h2 class="text-black  font-semibold">{{ $offer->title }}</h2>
            <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-btn-register " type="submit">
                {{ __('Troquez Maintenant ') }}
            </button>
            <div class="border pt-4 flex rounded-lg flex-col ">
                <div class="flex pb-3 px-12 gap-2 flex-col ">
                    <div class="flex  items-center   ">
                        <span class="w-[35%]">
                            Type de troc:
                        </span>
                        <span class="text-black text-lg ">
                            {{$offer->type->name }}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Categorie:
                        </span>
                        <span class="text-black text-lg flex items-center div-categorie">
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
                        <span class="text-black text-lg flex ">
                            {{ $offer->user->created_at->format('d M Y | H:i:s') }}
                        </span>
                    </div>
                </div>
                <div class=" border-y py-3 ">
                    <div class=" px-12 flex    items-center">

                        <span class="w-[35%]">
                            L’etat:
                        </span>
                        <span class="text-black text-lg flex ">
                            &#128578; Tres bon etat
                        </span>
                    </div>
                </div>
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

                        <span class="text-black text-2xl font-semibold">
                            {{$offer->price}} €
                        </span>
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
                <h4 class="text-black border-b px-5 py-4">Vendeur</h4>
                <div>
                    <div class="flex justify-between px-4 py-2">
                        <div class="flex gap-3  ">
                            <img src="{{ $offer->user->profile_photo_path }}" alt="" class="rounded-full">
                            <span class="flex flex-col">
                                <span class="text-black font-medium">
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
                        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-btn-register">
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
                            class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-700 hover:text-white"></i></a>
                    <a href="#">
                        <i
                            class="fa-brands fa-twitter text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                    </a>
                    <a href="#">
                        <i
                            class="fa-brands fa-instagram text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                    </a>
                    <a href="#"><i
                            class="fa-brands fa-youtube text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i></a>
                    <a href="#"><i
                            class="fa-brands fa-linkedin text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i></a>
                    <a href="#"><i
                            class="fa-brands fa-whatsapp text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i></a>

                </div>
            </div>
        </div>
        <script>
            function changeMainImage(newImage) {
        const mainImage = document.getElementById('mainImage');
        mainImage.src = newImage;
    }
        </script>


</x-app-layout>
