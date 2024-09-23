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
    <div class="offre-page mx-9 my-2">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>
    @php
    $conditionMapping = [
    'NEW' => '🙂 Neuf',          
    'VERY_GOOD' => '😊 Très bon état',  
    'GOOD' => '👍 Bon état',     
    'MEDIUM' => '😐 Etat moyen', 
    'BAD' => '👎 Mauvais état', 
    'BROKEN' => '😞 En panne',
    ]; 
    $experienceMapping = [
        'NO_EXPERIENCE' => '🌱 Débutant',
        'LESS_THAN_5_YEARS' => '👦 Junior',
        'BETWEEN_5_AND_10_YEARS' => '🧑 Intermédiaire',
        'BETWEEN_10_AND_25_YEARS' => '🧔 Senior',
        'MORE_THAN_25_YEARS' => '🔥 Expert',
    ];  
    @endphp
    <div id="lightbox"></div>
    <div class="flex gap-5 offre-page">
        <div class="w-[50%] ml-12 partie-slide">
            <div class=" flex flex-col gap-6">
                <div class="">
                    <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}"
                        alt="Image principale" id="mainImage"  class="zoomD h-[450px] w-[750px] rounded-lg " />
                </div>
                @if(auth()->check() && $offer->user_id === auth()->user()->id)
                <div class="flex space-x-10">
    <div id="offer-secondary-images" class="w-4/5">
        <div class="flex items-center">
            <i class="fa fa-arrow-circle-left"></i>
            <div id="offer-secondary-images-container" class="flex flex-nowrap overflow-x-hidden space-x-0 mx-2">
                @foreach ($images as $img)
                    <div class="basis-1/3 grow-0 shrink-0 px-1">
                        <div class="relative">
                            <img src="{{ route('offer-pictures-file-path', $img->offer_photo) }}" alt="Image produit"
                                class="zoomD h-[80px] hover:scale-110 rounded-lg hover:transition-transform hover:transform-gpu w-full"
                                onmouseover="changeMainImage('{{ $img->offer_photo }}')"
                                onmouseout="changeMainImage('{{ $offer->offer_default_photo }}')" />
        
                            <div class="mt-1 flex justify-center space-x-2">
                                <button class="bg-red-500 text-white p-1 rounded-full" onclick="deleteImage('{{ $img->id }}')">Delete</button>
                                <button class="bg-blue-500 text-white p-1 rounded-full" onclick="selectImage('{{ $img->offer_photo }}')">Select</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <i class="fa fa-arrow-circle-right"></i>
        </div>
        <div class="steps flex items-center justify-center space-x-2 mt-2">
            @foreach ($images as $i => $img)
                <div class="step h-4 w-4 @if(!$i)bg-slate-500 @else bg-slate-200 @endif rounded-full"></div>
            @endforeach
        </div>
    </div>
 <div class="slick-item" style="height: 30px; width: 30px;" >
            <input id="additional_images" type="file" name="additional_images[]" multiple style="display: none;">
            <button  onclick="openAdditionalImageInput()"><img src="{{ asset('images/add_icon.png') }}" /></button>
        </div>
        <div class="slick-item" style="height: 30px; width: 30px;" >
        <button id="toggleAnimation">
            @if ($offer->active_animation)
            <img src="{{ asset('images/pause.png') }}" />
@else
<img src="{{ asset('images/play.png') }}" />

            @endif
</button>
      </div>
     </div>
@else 
    <div class="slick-carousel  ">
        @foreach ($images as $img)
            <div class="slick-item">
                <div class="relative">
                    <img src="{{ route('offer-pictures-file-path', $img->offer_photo) }}" alt="Image produit"
                        class="zoomD h-[80px] hover:scale-110 rounded-lg hover:transition-transform hover:transform-gpu"
                        onmouseover="changeMainImage('{{ $img->offer_photo }}')"
                        onmouseout="changeMainImage('{{ $offer->offer_default_photo }}')" />

                    <div>
                        <button class="bg-red-500 text-white p-1 rounded-full" onclick="deleteImage('{{ $img->id }}')">Delete</button>
                        <button class="bg-blue-500 text-white p-1 rounded-full" onclick="selectImage('{{ $img->offer_photo }}')">Select</button>
                    </div>
                </div>
            </div>
        @endforeach
       
    </div>
 
      
     @endif
<style>.slick-prev:before, .slick-next:before {
    color:black;
}</style>
<script>
    // Initialize the Slick carousel
   var init={
            dots:true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button" class="slick-next">Next</button>',
        };

    $(document).ready(function(){
        $('#toggleAnimation').click(function() {
            $.ajax({
                type: 'POST',
                url: '{{ route("offers.updateActiveAnimation") }}?offerId=' + "{{$offer->id}}",
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        // Update the UI or perform other actions based on the response
location.reload();                   
 } else {
                        console.error('Failed to toggle active animation.');
                    }
                },
                error: function() {
                    console.error('Error in AJAX request.');
                }
            });
        });
        //
        if(!parseInt("{{$offer->active_animation}}")){
            init.autoplay=false;
        $('.slick-carousel').slick(init);} else {
            init.autoplay=true;
            $('.slick-carousel').slick(init);
        }
    });
</script>


            </div>
            <script> 
            function openAdditionalImageInput() {
        // Trigger the click event of the existing input field
        $('#additional_images').click();

        // Listen for file input change
        $('#additional_images').change(function () {
            // Get the selected files
    var files = $('#additional_images')[0].files;
            // Create a FormData object
            var formData = new FormData();
            formData.append('offer_id', "{{$offer->id}}");

            // Append each file to the FormData object
            for (var i = 0; i < files.length; i++) {
                formData.append('additional_images[]', files[i]);
               
            }
            if (formData.has('additional_images[]')) {
                console.log("FormData contains files:", formData);}

            $.ajax({
    type: "POST",
    url: "{{ route('offer.storeImage') }}",
    data: formData,
    contentType: false,
    processData: false,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
        location.reload();
    },
    error: function (error) {
        console.error(error);
    }
});

        });
    }
            //
            function selectImage(imagePath) {
 
        // Send AJAX request to update the server-side
        $.ajax({
            type: "POST",
            url: "{{ route('myaccount.updateOfferImages', $offer->id) }}",
            data: { default_image: imagePath },
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
     function deleteImage(imageId) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('offers.deleteImage') }}",
            data: { imageId: imageId },
            success: function (response) {
                location.reload();

            },
            error: function (error) {
                console.error(error);
            }
        });
    }
</script>
            <div class="my-5">
                <div class="my-3">
                    <h2 class="text-titles ">Description</h2>
                    <p>{{ $offer->description }}</p>
                </div>
                <div id="map" class=" mt-5">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCh3N9L9mNF9a2pBg_ZkhK03DfLKt87tY0&q={{str_replace(' ', '+', $offer->department)}}"
                        class="h-[400px] w-[100%]" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <!-- <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5916333.136450014!2d-1.3992720794176445!3d43.60998660794066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6af0725dd9db1%3A0xad8756742894e802!2sMontpellier%2C%20France!5e0!3m2!1sfr!2sma!4v1697796341376!5m2!1sfr!2sma"
                        class="h-[400px] w-[100%]" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                </div>
            </div>
        </div>
        <div class="w-[38%] partie-detail">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex justify-between">
            <h2 class="text-titles  font-semibold">{{ $offer->title }}</h2>
            @if ($offer->favoritedBy->contains(auth()->user()))
    <!-- If offer is favorited, show remove from favorites form -->
    <form method="POST" action="{{ route('offers.removeFromFavorites', ['offer' => $offer]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">
        Retirer des favoris            <!-- Display active (favorited) icon -->
            <i class="fas fa-heart"></i>
        </button>
    </form>
@else
    <!-- If offer is not favorited, show add to favorites form -->
    <form method="POST" action="{{ route('offers.addToFavorites', ['offer' => $offer]) }}">
        @csrf
        <button type="submit">
        Ajouter aux favoris            <!-- Display inactive (not favorited) icon -->
            <i class="far fa-heart"></i>
        </button>
    </form>
@endif
</div>

            @auth
    <form action="{{ route('propositions.create', ['offerid' => $offer->id,'userid'=>auth()->id()]) }}" method="get">
        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
            {{ __('Troquez Maintenant ') }}
        </button>
    </form>
@else
<form action="{{ route('login') }}" method="get">
        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
            {{ __('Troquez Maintenant ') }}
        </button>
    </form>
@endauth

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
                            {{$offer->subcategory->parent->name}}
                            <img src="/images/chevron-right.svg" alt="" class="px-2">
                            {{$subcategory->name}}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Mis en ligne le:
                        </span>
                        <span class="text-titles text-lg flex ">
                            {{ $offer->created_at->format('d M Y | H:i:s') }}
                        </span>
                    </div>
                </div>
                @if($offer->condition && $offer->type->name=="Bien")
                <div class=" border-y py-3 ">
                    <div class=" px-8 flex    items-center">
                        <span class="w-[35%]">
                            L’etat:
                        </span>
                        <span class="text-titles text-lg flex gap-2 ">
                            <p>{{ $conditionMapping[$offer->condition] }}</p>
                        </span>
                    </div>
                </div>
                @endif
                @if($offer->experience && $offer->type->name=="Service")
                <div class=" border-y py-3 ">
                    <div class=" px-8 flex    items-center">
                        <span class="w-[35%]">
                            Le niveau:
                        </span>
                        <span class="text-titles text-lg flex gap-2 ">
                            <p>{{ $experienceMapping[$offer->condition] }}</p>
                        </span>
                    </div>
                </div>
                @endif
                <div class="border-b py-3">
                    <div class="px-12 flex   gap-2 items-center">
                        <img src="/images/map-pin.svg" alt="">
                        <span class="">
                            {{$offer->department->region->name . ", " .
                            $offer->department->name}}
                        </span>
                    </div>
                    @if(auth()->check() && $offer->user_id === auth()->user()->id)
                            </div>
                <div class="flex flex-col items-center pt-3">
    <h2 class="text-center text-black">Propositions sur cette offre</h2>

   
        @foreach ($offer->preposition as $proposition)
            <a href="{{route('propositions.index', ['in_progress'=>0])}}" style="color:white;" class="ml-5 w-50 mt-2 btn proposition-link badge {{ getStatusBadgeClass($proposition->status) }}">
                {{ $proposition->name }}
            </a>
            <!-- <a href="#" style="color:white;" class="ml-5 w-50 mt-2 btn proposition-link badge {{ getStatusBadgeClass($proposition->status) }}" data-bs-toggle="modal" data-bs-target="#exampleModal" 
            data-id="{{ $proposition->id }}" data-image="{{ route('proposition-pictures-file-path', $proposition->images ? $proposition->images : '') }}"  
            data-status="{{ $proposition->status }}" data-user="{{ $proposition->user }}" data-offer="{{ $proposition->offer }}" data-meet="{{ $proposition->meetup }}">
                {{ $proposition->name }}
            </a> -->
        @endforeach
    @endif
</div>

                <div class=" pt-3">
                    <div class="px-12 flex justify-content-between  gap-2 items-center">
                        @if($offer->price)
                        <span class="text-titles text-2xl font-semibold">
                            {{$offer->price}} €
                        </span>
                        @endif
                        @if ($offer->buy_authorized)
                        <span class="flex bg-red-100  rounded-full px-3 py-1 gap-2 text-red-500">
                            <span class="bg-red-500 px-2 rounded-full text-white">$</span>
                            <span>Vente autorisé</span> 
                            
                           
                        </span>@endif
                    </div>
                    <div class="m-4 bg-gray-100 p-4 rounded-lg">
                        <h5>À ÉCHANGER CONTRE :</h5>
                        <span class="flex gap-2 px-5">
                        @if($offer->specify_proposition)
                            <img src="/images/Icon.svg" alt="">
                            <span>
                                Etudie toute proposition
                            </span>
                            @endif
                        </span>
                        @if($offer->dynamic_inputs)
                        @foreach (json_decode($offer->dynamic_inputs, true)?? [] as $prop )
                            @if($prop!=null)
                            <span class="flex gap-2 px-5">
                            <img src="/images/Icon.svg" alt="">  {{$prop}} </span>
                            @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="report-button my-4 text-red-700 justify-center border-black py-2 border-b rounded-lg flex gap-2 w-52"
                data-offer-id="{{ $offer->id }}" data-offer-name="{{ $offer->name }}">
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
                                    {{$offer->user->name}}
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
                                {{$offer->user->ratings->avg('stars')}} ({{$offer->user->ratings->count()}} avis)
                            </span>
                            <span class="flex">
                            @for ($i =1; $i <= 5; $i++)
                                    <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden rate" />
                                    <label for="star{{$i}}" title="{{$i}} star" class="cursor-pointer text-2xl text-yellow-500 rate" >
                                        @if($offer->user->ratings->avg('stars')>=$i)
                                        &#9733;
                                        @else
                                        &#9734;
                                        @endif
                                    </label>
                                @endfor               
                            </span>
                        </div>
                    </div>
                    <div class="m-4 flex gap-4 justify-content-between">
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">{{$offer->user->prepositions->count()}}</span>
                            Trocs
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">{{$offer->user->offer->count()}}</span>
                            Offres
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">{{$offer->user->ratings->count()}}</span>
                            Avis
                        </div>
                    </div>
                    <div class=" flex px-3 gap-4">
                        <button onclick="location.href='/compte/{{$offer->user_id}}'"
                            class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover">
                            Voir Profile
                        </button>
                        <button onclick="location.href='/moncompte/mesmessages/{{$offer->user_id}}'"
                            class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-black ">
                            Contact
                        </button>
                    </div>
                </div>
            </div>
            <div class="m-auto mt-5 w-[60%]  ">
                <h5 class="mb-4">
                    Partager cette annonce à vos amis
                </h5>
                <div class=" flex justify-content-between social-button">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}">
                        <i id="facebookBtn" class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}&text={{ rawurlencode($offer->name) }}">
                        <i id="twitterBtn" class="fa-brands fa-twitter text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="instagram://share?text={{ rawurlencode('Check out this offer on Faitroquez.fr: ' . route('offer.offer', ['offerId' => $offer->id, 'slug' => $offer->slug])) }}">
                        <i id="instagramBtn" class="fa-brands fa-instagram text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?url={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}&title={{ rawurlencode($offer->name) }}">
                        <i id="linkedinBtn" class="fa-brands fa-linkedin text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}">
                        <i id="whatsappBtn" class="fa-brands fa-whatsapp text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>           
                </div>
            </div>
        </div>
    </div>
    <section class="similarOffers mt-4">
        <div class="flex justify-between px-24">
            <h1 class="mb-6 ml-12 font-sans text-2xl font-bold text-gray-900">Offres similaire</h1>
            <button class="bg-primary-color hover:bg-primary-hover mr-12 text-white font-bold py-2 px-4 rounded-2"><a class="no-underline font-medium text-white" href="{{ route('category.showSimilarOffers', ['offer'=>$offer->id ,'category_id' => $offer->subcategory->parent_id, 'category_name' => $category->name])}}">Voir plus</a></button>
        </div>
        <div class="mx-auto grid max-w-screen-xl grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($similaroffers as $similar)
                <x-offer-present-card :offer=$similar></x-offer-present-card>                  
                @endforeach
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Offre</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div id="modalbox"></div>
                    <div class="w-full text-xs text-red-600">(*) Si vous acceptez cette proposition, vous ne pourrez plus accepter d'autres propositions liées a cette offre, à moins ce que la contrepartie ne confirme pas la proposition</div>
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Nom</th>
                                <th>Statut</th>
                                <th>Image</th>
                                <th>Utilisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="modalName"></td>
                                <td id="modalStatus"></td>
                                <td> <img id="modalImage" src="" class="modalzoomD" style="max-width:200px;" alt="Image"> </td>
                                <td id="modalUser"></td>
                                <td>
                                    <button type="button" class="btn btn-success" id="acceptButton" data-bs-dismiss="modal" aria-label="Fermer">
                                        Accepter
                                    </button>
                                    <button type="button" class="btn btn-danger" id="declineButton" data-bs-dismiss="modal" aria-label="Fermer">
                                        Refuser
                                    </button>
                                    <button type="button" class="btn btn-primary m-1" id="meetButton">
                                        <i class="fa fa-calendar"></i> Ajouter un rendez-vous
                                    </button>

                                    <a href="{{route('propositions.chat-sender',['prepositionId' => 'PROPOSITION_ID_PLACEHOLDER'] )}}" type="button" class="btn btn-primary m-1" id="chatButton">
                                        <i class="fas fa-comment"></i> Chat
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 id="meetHeader">Rendez-vous</h2>
                    <table id="meetTable" class="table align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Description</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody id="meetupsTableBody">
                            <td id="meetDate"></td>
                            <td id="meetTime"></td>
                            <td id="meetDescription"></td>
                            <td id="meetStatus"></td>
                        </tbody>
                    </table>
                    <form id="meetupForm">
                        @csrf
                        <input type="hidden" id="prepositionId" name="prepositionId" value="">
                        <input type="hidden" id="userId" name="userId" value="auth()->id()">
                        <div class="mb-3">
                            <label for="meetupDate" class="form-label">Date du rendez-vous</label>
                            <input type="date" class="form-control" id="meetupDate" name="meetupDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="meetupTime" class="form-label">Heure du rendez-vous</label>
                            <input type="time" class="form-control" id="meetupTime" name="meetupTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="meetupDescription" class="form-label">Description du rendez-vous</label>
                            <textarea class="form-control" id="meetupDescription" name="meetupDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Planifier le rendez-vous</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

<script>

        function changeMainImage(newImage) {
            const mainImage = document.getElementById('mainImage');
                mainImage.src = window.location.origin +'/storage/offer-pictures/'+newImage;
        }
   
    $(document).ready(function () {
//animations
var imageIndex = 0;
    var intervalId;

    function animateImages() {
      // Move the images from left to right
      $(".flex.scrollBar").animate({
        scrollLeft: imageIndex * 120 // Adjust the value based on your image size and spacing
      }, 1000);

      imageIndex = (imageIndex + 1) % $(".flex.scrollBar img").length;
    }

    // Start the animation every 3 seconds
    intervalId = setInterval(animateImages, 3000);

    // Toggle animation on button click
    $("#toggleAnimation").click(function() {
      if (intervalId) {
        clearInterval(intervalId);
        intervalId = null;
      } else {
        intervalId = setInterval(animateImages, 3000);
      }
    });

        //
        var departmentValue = "{{ request('department') }}";
        var typeValue = "{{ request('type') }}";
        // Set the selected attribute for the department dropdown
        $("#departmentSelect").val(departmentValue).prop('selected', true);

        // Set the selected attribute for the type dropdown
        $("#typeSelect").val(typeValue).prop('selected', true);
        $('#exampleModal').on('hidden.bs.modal', function () {
            $("#meetupForm").hide();
    });
        $('.proposition-link').click(function () {
            // Get data from the clicked link
            var propositionName = $(this).text();
            var propositionStatus = $(this).data('status'); // Adjust based on your data attributes
            var propositionUser = $(this).data('user'); // Adjust based on your data attributes
            var propositionId=$(this).data('id');
            var propositionImage=$(this).data('image');
            var user=propositionUser.first_name+" "+propositionUser.last_name;
            var descriptionData=$(this).data('meet');
            console.log(descriptionData);
            var meetDescription=descriptionData.description;
            var meetDate=descriptionData.date;
            var meetTime=descriptionData.time;
            var meetStatus=descriptionData.status;
// Set the value of the hidden input in meetup form
            $('#prepositionId').val(propositionId);
            // Update modal content
            $('#modalName').text(propositionName);
            $('#modalStatus').text(propositionStatus);
            $('#modalUser').text(user);
            $('#modalImage').attr('src',propositionImage);
            // Update propositionId in button data attributes
            $('#acceptButton').data('proposition-id', propositionId);
            $('#acceptButton').data('proposition-id', propositionId);
            $('#declineButton').data('proposition-id', propositionId);
            //chatbutton
            var chatButton = document.getElementById('chatButton');
    chatButton.href = chatButton.href.replace('PROPOSITION_ID_PLACEHOLDER', propositionId);
            // add meetup in table 
            if(descriptionData){
            $('#meetDescription').text(meetDescription);
            $('#meetDate').text(meetDate);
            $('#meetTime').text(meetTime);
            $('#meetStatus').text(meetStatus);
            $('#meetButton').hide();
            $('#meetHeader').show();
            $('#meetTable').show();
        } 
            else {
                $('#meetDescription').empty();
            $('#meetDate').empty();
            $('#meetTime').empty();
            $('#meetStatus').empty();
            $('#meetButton').show();
            $('#meetHeader').hide();
            $('#meetTable').hide();
            }

            if(propositionStatus=="Acceptée" || propositionStatus=="Rejetée" ){
                $('#acceptButton').hide();
                $('#declineButton').hide();
            }
            else{
                $('#acceptButton').show();
                $('#declineButton').show();
            }
           
        });
          // Handle Accept button click
          $('#acceptButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'Acceptée');
        });

        // Handle Decline button click
        $('#declineButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'Rejetée');
        });
 // Handle Meet button click
 $("#meetupForm").hide();
 $('#meetButton').click(function () {
    $("#meetupForm").show();

});
        // Function to update proposition status via AJAX
    function updatePropositionStatus(propositionId, newStatus) {
        // Send an AJAX request to update the status
        $.ajax({
            type: 'POST',
            url: '/update-proposition-status', // Replace with your actual route
            data: {
                propositionId: propositionId,
                newStatus: newStatus,
            },
            success: function (response) {
                // Handle success response

if(newStatus=="Rejetée")
  Swal.fire({
    title: 'Success',
    icon: 'success',
    text: 'Vous avez refusé la proposition.',
  }).then(function () {
                    location.reload();
                });
    else if(newStatus=="Acceptée")
    Swal.fire({
        title: 'Success',
        icon: 'success',
        html: '<div class="flex items-center justify-center space-x-2">' +
        '<input type="radio" id="star1" name="rating" value="1" class="hidden" /><label for="star1" title="1 star" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star2" name="rating" value="2" class="hidden" /><label for="star2" title="2 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star3" name="rating" value="3" class="hidden" /><label for="star3" title="3 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star4" name="rating" value="4" class="hidden" /><label for="star4" title="4 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star5" name="rating" value="5" class="hidden" /><label for="star5" title="5 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '</div>' +
            '<div id="feedback-container" style="display:none">' +
            '<textarea id="feedback" name="feedback" class="swal2-textarea" rows="4" cols="35" placeholder="Give Feedback"></textarea>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Rate',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (result) => {
        const rating=document.querySelector('input[name="rating"]:checked');
        const ratingValue = rating? rating.value:0;
        const feedbackValue = document.getElementById('feedback').value;

        return fetch('/ratings/rateOfferCounterParty', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                propositionId: propositionId,
                stars: ratingValue,
                feedback: feedbackValue,
                _token: '{{csrf_token()}}'
            }),
        })
            .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to submit rating');
            }
            return response.json();
            })
            .catch((error) => {
            Swal.showValidationMessage(`Request failed: ${error}`);
           });
        },
        didOpen: () => {
        const stars = document.querySelectorAll('input[name="rating"]');
        stars.forEach((star) => {
            star.addEventListener('click', () => {
                stars.forEach((starAll) => {
                    starAll.nextElementSibling.innerHTML = '&#9734;'; // Empty star
                });
                stars.forEach((starInf) => {
                    if (starInf.value <= star.value) {
                        starInf.nextElementSibling.innerHTML = '&#9733;'; // Filled star
                    }
                });

                const feedback=document.getElementById('feedback-container');
                feedback.style.display="block";

            });

        });
        },
    }).then(function () {
                    location.reload();
                });

            else {
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'The proposition rating has been updated.',
                }).then(function () {
                                    location.reload();
                                });
            }
            },
            error: function (error) {
            console.log({error});
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update proposition rating.',
                });
            }
        });
    }

});
    // for meetup form
    $(document).ready(function () {
        // Handle form submission
        $('#meetupForm').submit(function (e) {
            e.preventDefault();

            // Get form data
            var formData = {
                prepositionId: $('#prepositionId').val(),
                meetupDate: $('#meetupDate').val(),
                meetupTime: $('#meetupTime').val(),
                meetupDescription: $('#meetupDescription').val(),
                userId: $('#userId').val(), 

            };
            console.log(formData);

            // Perform AJAX request to save meetup schedule
            $.ajax({
                url: '/schedule-meetup',
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success response
                    console.log(response);

                    // Optionally, close the modal after a successful update
                    $('#meetupModal').modal('hide');

                    Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Rencontre ajoutée.',
            }).then(function () {
                // Reload the page after showing the success message
                location.reload();
            });
        },
        error: function (error) {
            
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Erreur',
            });
               
                }
            });
        });

        // Open the modal and set the prepositionId
        $('#meetupModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var prepositionId = button.data('preposition-id'); // Extract info from data-* attributes
            $('#prepositionId').val(prepositionId); // Set the prepositionId in the form
        });
    });

var meetups = {};

// Function to populate the meetups table
function populateMeetupsTable() {
    var meetupsTableBody = document.getElementById('meetupsTableBody');

    // Clear existing rows
    meetupsTableBody.innerHTML = '';

    // Loop through meetups and add rows to the table
    
        var row = meetupsTableBody.insertRow();
        var dateCell = row.insertCell(0);
        var timeCell = row.insertCell(1);
        var descriptionCell = row.insertCell(2);
        var statusCell = row.insertCell(3);

        // Set cell values based on meetup data
        dateCell.innerHTML = meetup.date;
        timeCell.innerHTML = meetup.time;
        descriptionCell.innerHTML = meetup.description;
        statusCell.innerHTML = meetup.status;
    
}

// Event listener for modal show event
$('#yourModalId').on('show.bs.modal', function (event) {
   
    document.getElementById('modalName').innerHTML = preposition.name;
    document.getElementById('modalStatus').innerHTML = preposition.status;
    document.getElementById('modalUser').innerHTML = preposition.user_name;

    // Populate meetups table
    populateMeetupsTable();
});


$(document).on('click', '.report-button', function () {
        // Retrieve the prepositionId from the data attribute
        var offerId = $(this).data('offer-id');
        var offerName = $(this).data('offer-name');
        
        // Call the updateProposition function with the prepositionId
        reportOffer(offerId,offerName);
    });
    function reportOffer(offerId,offerName) {
    Swal.fire({
        title: 'offer '+offerName,
        html: '<div class="flex justify-start">' +
        '<input id="report-title" name="title" class="swal2-input ms-auto w-full"  placeholder="Title">' +
        '</div>' +
            '<div id="flex justify-start description-container">' +
            '<textarea id="report-description" name="description" class="swal2-textarea ms-auto w-full" rows="4"  placeholder="Give description"></textarea>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Report',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (result) => {
        const titleValue = document.getElementById('report-title').value;
        const descriptionValue = document.getElementById('report-description').value;
        return fetch('/offer/report/'+offerId, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: titleValue,
                description: descriptionValue,
                _token: '{{csrf_token()}}'
            }),
        })
            .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to submit report');
            }
            return response.json();
            })
            .catch((error) => {
            Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        
    }).then(function () {
                    location.reload();
                });

                
    }
    </script>
        
</x-app-layout>
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'Rejetée':
                return 'bg-danger';
            case 'En cours':
                return 'bg-warning';
            case 'Acceptée':
                return 'bg-success';
           
        }
    }
    @endphp
 <script>window.onload = () => {
  // (A) GET LIGHTBOX & ALL .ZOOMD IMAGES
  let all = document.getElementsByClassName("zoomD");
  let modalall = document.getElementsByClassName("modalzoomD"),

      lightbox = document.getElementById("lightbox");
      modalbox = document.getElementById("modalbox");
 
  // (B) CLICK TO SHOW IMAGE IN LIGHTBOX
  // * SIMPLY CLONE INTO LIGHTBOX & SHOW
  if (all.length>0) { for (let i of all) {
    i.onclick = () => {
      let clone = i.cloneNode();
      clone.className = "";
      lightbox.innerHTML = "";
      lightbox.appendChild(clone);
      lightbox.className = "show";
    };
  }}
  if (modalall.length>0) { for (let i of modalall) {
    i.onclick = () => {
      let clone = i.cloneNode();
      clone.className = "";
      clone.style.maxWidth="";
      modalbox.innerHTML = "";
      modalbox.appendChild(clone);
      modalbox.className = "show";
    };
  }}
 
  // (C) CLICK TO CLOSE LIGHTBOX
  lightbox.onclick = () => lightbox.className = "";
  modalbox.onclick = () => modalbox.className = "";
};
$(document).ready(function () {
        let all = document.getElementsByClassName("zoomD"),
        lightbox = document.getElementById("lightbox");
        
        // (B) CLICK TO SHOW IMAGE IN LIGHTBOX
        // * SIMPLY CLONE INTO LIGHTBOX & SHOW
        if (all.length>0) { for (let i of all) {
            i.onclick = () => {
            let clone = i.cloneNode();
            clone.className = "";
            lightbox.innerHTML = "";
            lightbox.appendChild(clone);
            lightbox.className = "show";
            };
        }}
        
        // (C) CLICK TO CLOSE LIGHTBOX
        lightbox.onclick = () => lightbox.className = "";
        
        var scrollDistance = $(`#offer-secondary-images`).width()/3;
        $(`#offer-secondary-images .fa-arrow-circle-left`).css(`-webkit-text-stroke`," 0.5px");
        
        $(`#offer-secondary-images .fa-arrow-circle-left`).click(function () {
            $(`#offer-secondary-images-container`).animate({scrollLeft: "-=" + scrollDistance}, "slow");
            if($(`#offer-secondary-images-container`).scrollLeft() > 0)
            $(`#offer-secondary-images .fa-arrow-circle-left`).css("-webkit-text-stroke","");
            else            
            $(`#offer-secondary-images .fa-arrow-circle-left`).css("-webkit-text-stroke"," 0.5px");
            nextPrev(-1);
        });
        
        $(`#offer-secondary-images .fa-arrow-circle-right`).click(function () {
            $(`#offer-secondary-images-container`).animate({scrollLeft: "+=" + scrollDistance}, "slow");
            if($(`#offer-secondary-images-container`).scrollLeft() < $(`#offer-secondary-images-container`).prop("scrollWidth") - $(`#offer-secondary-images-container`).width())
            $(`#offer-secondary-images .fa-arrow-circle-right`).css("-webkit-text-stroke","");
            else            
            $(`#offer-secondary-images .fa-arrow-circle-right`).css("-webkit-text-stroke"," 0.5px");
            nextPrev(1);
        });
        
        function nextPrev(delta){
            var n = 0;
            var elts = $('.steps .step');
            elts.each(function(index, element) {
                if($(element).hasClass('bg-slate-500')){
                    n = index;
                    $(element).removeClass('bg-slate-500');
                }else{
                    $(element).removeClass('bg-slate-200');
                }
            });
            n += delta;
            if(n<0) n = 0;
            if(n>= elts.length) n = elts.length - 1;
            console.log({n});
            
            elts.each(function(index, element) {
                if(index == n){
                    $(element).addClass('bg-slate-500');
                }else{
                    $(element).addClass('bg-slate-200');
                }
            });
        }
    });

</script>
