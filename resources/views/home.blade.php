<x-app-layout>
<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "f5408d83-371c-46f0-b800-6a1d310552c4",
    });
    console.log(OneSignal);
  });
</script>
</script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js">
</script>
 <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js">
   </script>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!-- Link Swiper's CSS -->
   
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- (A) LIGHTBOX CONTAINER -->
<div id="lightbox"></div>
@php
    $leftBannerShown = false;
    $rightBannerShown = false;
@endphp
@foreach ($banners as $banner)
        @if ($banner->is_active && ($banner->page === 'home' || $banner->page ==='all') && $banner->position === 'top')
        <a href="{{$banner->description}}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:100%;max-height:260px;">
            </a>
            @endif
            @if ($banner->is_active && ($banner->page === 'home' || $banner->page ==='all') && $banner->position === 'left')
            @php
            $leftBannerShown = true;
        @endphp        <a href="{{$banner->description}}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" id="left" alt="Banner" class="responsive-image">
        </a>
            @endif
        @if ($banner->is_active && ($banner->page === 'home' || $banner->page ==='all') && $banner->position === 'right')
        @php
            $rightBannerShown = true;
        @endphp        <a href="{{$banner->description}}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" id="right" alt="Banner" class="responsive-image" style="right:0;margin-top:260px;">
        </a>
        @endif
    @endforeach
    <style>
    .responsive-image {
        max-width: 300px;      height: auto;
        position: fixed;
    }

    @media (max-width: 768px) {
        .responsive-image {
           display:none;
        }
        .con{
            margin:0 !important;
            max-width: auto !important;
        }
    }
</style>

@php
    $bothBannersShown = $leftBannerShown && $rightBannerShown;
    $onlyLeftBannerShown = $leftBannerShown && !$rightBannerShown;
    $onlyRightBannerShown = !$leftBannerShown && $rightBannerShown;
    $noBannersShown = !$leftBannerShown && !$rightBannerShown;
@endphp
@if ($bothBannersShown)
    <div class="con" style="margin-left:300px; margin-right:300px; max-width:55%;">
@elseif ($onlyLeftBannerShown)
<div class="con" style="margin-right:10px; margin-left: 310px;">
@elseif ($onlyRightBannerShown)
<div class="con" style="margin-left:20px; margin-right:310px;">
@else
<div >
@endif    

<div class="swiper mySwiper flex flex-col justify-center " style="height:80vh">
   <div class="content" style="width: 100%;
    position: absolute;
    top: 20%;
    text-align: center;
    z-index: 3;">
   
   
   <div class="d-flex align-items-center justify-content-center">
    <div>
        <h1 class="titlee">Avez-vous un bien ou un service ?<br>cherchez, postez et <span style="font-size: 41px;font-weight: 800;color:#24a19c;" >troquez</span>  !</h1>
        <div class="mt-4 d-flex align-items-center justify-content-center" >
            <a class="sg-btn" href="{{route('alloffers.index')}}">Consultez nos offres <i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
    </div>  
    </div>
    <h1 class="titlee text-center font-bold">Ne perdez plus votre temps et rejoignez notre réseau de <span style="font-size: 41px;font-weight: 800;color:#24a19c;">troqueurs </span> !</h1>

    </div>  

    <div class="swiper-wrapper" >

      <div class="swiper-slide">  <img  class="brightness" src="https://www.nowteam.net/wp-content/uploads/2021/01/AdobeStock_283137103-1080x675.jpeg" alt=""  >   </div>
      <div class="swiper-slide" id ="slide2"><img  class="brightness" src="https://www.londonlibrary.co.uk/images/CHARLOTTE/NEW_WEBSITE_IMAGES/LF_Wide_Back_Stacks.jpg" alt="" ></div>
      <div class="swiper-slide" id ="slide3"><img  class="brightness" src="https://static.vecteezy.com/system/resources/previews/024/903/858/non_2x/beautiful-women-in-fashionable-clothing-exude-elegance-generated-by-ai-free-photo.jpg" alt="" ></div>
      
    </div>
    
     

  </div>

    

<!-- <div class="grid-container">
    <div class="s">
        <h2 class="d-flex justify-content-center">Top Users</h2>
            <ul class="mt-4">
            @foreach ($topUsers as $user)
                <li class="user-item">
                    <div class="media">
                        <img src="{{ route('profile_pictures-file-path', $user->avatar) }}" class="rounded-full max-w-15 max-h-8" alt="{{ $user->name }} Avatar">
                    </div>
                    <div class="details">
                        <a class="sg-home-link" href="#" data-target="#LoginProfilModal104" data-toggle="modal">{{ $user->name }}</a>
                        <div class="offer-count">
                            <span>{{ $user->offer_count }} trocs publiés</span>
                        </div>
                    </div>
                </li>
            @endforeach

            </ul>
    </div>

    <div class="s">
        <h2 class="d-flex justify-content-center">Top Categories</h2>
        
            <ul class="mt-4">
                @foreach($topCategories as $category)
                    <li><a href="#" class="list-item-link">{{ $category->name }} ({{ $category->offer_count }})</a></li>
                @endforeach
            </ul>
        </div>


    <div class="s">
        <h2 class="d-flex justify-content-center">Top Regions</h2>
            <ul class="mt-4">
                @foreach($topRegions as $region)
                    <li><a href="#" class="list-item-link">{{ $region->name }} ({{ $region->offer_count }})</a></li>
                @endforeach
            </ul>
    </div>
</div> -->

        <div id="catcarousel" class="grid grid-cols-3 md:grid-cols-6 justify-content place-items-stretch center my-4 ml-2 mr-2 md:mr-32 md:ml-32">
            @for($i=0; $i< min(12,count($categories)); $i++)
            <a class="no-underline text-black block" href="{{route('alloffers.index',['category'=> $categories[$i]->id])}}">
                <div class="flex flex-col justify-between items-center border shadow py-2 mx-2 mb-4 h-full">
                    <div class="flex flex-col items-center">
                        <div class="bg-slate-100 rounded-full p-1 aspect-square"><i class="fa {{$categories[$i]['icon']}}"></i></div>
                        <div class="font-semibold pl-2">{{$categories[$i]->name}}</div>
                    </div>
                    <div class="text-sm">{{$categories[$i]->children->reduce(function($carry, $sub){return $carry + $sub->offer->where('active_offer', 1)->where('launch_date', null)->count();})}} Offres</div>
                </div>
            </a>
            @endfor
        </div>
        
        @if(count($categories)>12)
        <div class="col-span-full d-flex items-center justify-center">
            <a class="more-btn" style="font-size:14px;margin:0" href="{{route('alloffers.index')}}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
        @endif


    <div id="featured-offers" class="flex flex-col my-4 ml-2 mr-2 md:mr-24 md:ml-24 pb-12">
        <div id="featured-offers-title" class="flex justify-between">
            <h4>Offres en vedette</h4>
        <div class="flex">
             <i class="owl-carousel__prev pl-2 fa fa-long-arrow-left"></i>
             <i class="owl-carousel__next pl-2 fa fa-long-arrow-right"></i>
 
        </div>
        </div>
        <div id="featured-offers-container"  class="owl-carousel owl-six" data-inner-pagination="true" data-white-pagination="true" data-nav="false" data-autoPlay="true">

        @for ($i=0;$i<count($featuredOffers);$i++)
            <div class=" grow-0 shrink-0 @if($i>0) @endif h-full" style="width: 100%;">
                <x-offer-present-card :offer=$featuredOffers[$i]></x-offer-present-card>
            </div>
            @endfor
       
        </div>    
      
        @if(count($featuredOffers)>3)
        <div class="col-span-full d-flex items-center justify-end">
            <a class="more-btn" style="font-size:14px;margin:0" href="{{route('alloffers.index')}}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
        @endif
        </div>


        
      
    </div>

    <div id="recent-offers" class="flex flex-col  ml-2 mr-2 md:mr-24 md:ml-24 pb-12">
        <div id="recent-offers-title" class="flex justify-between">
            <h4>Plus récentes</h4>
            <div class="flex">
             <i class="owl-carousel__prev pl-2 fa fa-long-arrow-left"></i>
             <i class="owl-carousel__next pl-2 fa fa-long-arrow-right"></i>
 
        </div>

        </div>
        <div id="recent-offers-container" class="owl-carousel owl-six" data-inner-pagination="true" data-white-pagination="true" data-nav="false" data-autoPlay="true">
            @for ($i=0;$i<count($recentOffers);$i++)
            <div class=" grow-0 shrink-0 @if($i>0) @endif h-full" style="width: 100%;">
                <x-offer-present-card :offer=$recentOffers[$i]></x-offer-present-card>
            </div>
            @endfor
        </div>

        
        @if(count($recentOffers)>3)
        <div class="col-span-full d-flex items-center justify-end">
            <a class="more-btn" style="font-size:14px;margin:0" href="{{route('alloffers.index',['sort_by'=>'latest'])}}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
        @endif
    </div>

    <div id="featured-offers" class="flex flex-col my-4 mx-2 md:mx-24 pb-12">
    <div id="featured-offers-title" class="flex justify-between items-center mb-4">
        <h4>Offres en vedette</h4>
        <div class="flex">
            <i class="pl-2 fa fa-long-arrow-left"></i>
            <i class="pl-2 fa fa-long-arrow-right"></i>
        </div>
    </div>
    <div id="featured-offers-container" class="flex flex-nowrap overflow-x-auto space-x-5 mb-4">
        @for ($i=0; $i<count($featuredOffers); $i++)
            <div class="basis-full md:basis-1/3 grow-0 shrink-0">
                <x-offer-present-card :offer="$featuredOffers[$i]"></x-offer-present-card>
            </div>
        @endfor
    </div>
    @if(count($featuredOffers) > 3)
        <div class="flex justify-end">
            <a class="more-btn text-sm" href="{{ route('alloffers.index') }}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
    @endif
</div>

<div id="recent-offers" class="flex flex-col my-4 mx-2 md:mx-24 pb-12">
    <div id="recent-offers-title" class="flex justify-between items-center mb-4">
        <h4>Plus récentes</h4>
        <div class="flex">
            <i class="pl-2 fa fa-long-arrow-left"></i>
            <i class="pl-2 fa fa-long-arrow-right"></i>
        </div>
    </div>
    <div id="recent-offers-container" class="flex flex-nowrap overflow-x-auto space-x-5 mb-4">
        @for ($i=0; $i<count($recentOffers); $i++)
            <div class="basis-full md:basis-1/3 grow-0 shrink-0">
                <x-offer-present-card :offer="$recentOffers[$i]"></x-offer-present-card>
            </div>
        @endfor
    </div>
    @if(count($recentOffers) > 3)
        <div class="flex justify-end">
            <a class="more-btn text-sm" href="{{ route('alloffers.index', ['sort_by' => 'latest']) }}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
    @endif
</div>

<div class="background-image flex flex-col items-center">
    <div class="w-full max-w-6xl px-4 py-12">
        <h4 class="text-center text-xl font-bold mb-8 text-white">Déposer une annonce</h4>
        <div class="relative flex flex-col justify-center space-y-10 bg-cover bg-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Step 1 -->
                <div class="border bg-white p-4 rounded-lg shadow-md max-w-xs mx-auto">
                    <div class="flex justify-between items-center mb-2">
                        <i class="fa fa-list text-xl"></i>
                        <span class="text-4xl font-thin">01</span>
                    </div>
                    <h5 class="text-lg font-semibold mb-2">Créer un compte</h5>
                    <p class="text-sm">Cliquez sur "S'authentifier", choisissez "S'enregistrer" et ajoutez vos informations pour créer un compte.</p>
                </div>
                <!-- Step 2 -->
                <div class="border bg-white p-4 rounded-lg shadow-md max-w-xs mx-auto">
                    <div class="flex justify-between items-center mb-2">
                        <i class="fa fa-list text-xl"></i>
                        <span class="text-4xl font-thin">02</span>
                    </div>
                    <h5 class="text-lg font-semibold mb-2">Déposer une annonce</h5>
                    <p class="text-sm">Accédez à la rubrique, remplissez le formulaire avec les détails de votre offre et choisissez votre troc.</p>
                </div>
                <!-- Step 3 -->
                <div class="border bg-white p-4 rounded-lg shadow-md max-w-xs mx-auto">
                    <div class="flex justify-between items-center mb-2">
                        <i class="fa fa-list text-xl"></i>
                        <span class="text-4xl font-thin">03</span>
                    </div>
                    <h5 class="text-lg font-semibold mb-2">Obtenir des propositions</h5>
                    <p class="text-sm">Attendez les propositions des membres, activez "Étudie toutes propositions", et négociez via les messages.</p>
                </div>
            </div>
        </div>
        <h4 class="text-center text-xl font-bold mt-12 mb-8 text-black">Faire un troc</h4>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mx-4">
            <div class="flex flex-col border bg-white p-4 rounded-lg shadow-md items-center text-center">
                <div class="flex justify-center mb-4 text-blue-500">
                    <i class="fa fa-list text-3xl"></i>
                </div>
                <h5 class="text-lg font-semibold mb-2">Créer un compte</h5>
                <p>Inscrivez-vous pour commencer à échanger.</p>
            </div>
            <div class="flex flex-col border bg-white p-4 rounded-lg shadow-md items-center text-center">
                <div class="flex justify-center mb-4 text-green-500">
                    <i class="fa fa-list text-3xl"></i>
                </div>
                <h5 class="text-lg font-semibold mb-2">Envoyer une proposition</h5>
                <p>Explorez les offres, sélectionnez-en une et soumettez une proposition d'échange.</p>
            </div>
            <div class="flex flex-col border bg-white p-4 rounded-lg shadow-md items-center text-center">
                <div class="flex justify-center mb-4 text-red-500">
                    <i class="fa fa-list text-3xl"></i>
                </div>
                <h5 class="text-lg font-semibold mb-2">Obtenir l'acceptation</h5>
                <p>Attendez que votre proposition soit acceptée pour organiser un rendez-vous ou discuter.</p>
            </div>
            <div class="flex flex-col border bg-white p-4 rounded-lg shadow-md items-center text-center">
                <div class="flex justify-center mb-4 text-purple-500">
                    <i class="fa fa-list text-3xl"></i>
                </div>
                <h5 class="text-lg font-semibold mb-2">Effectuer l'échange</h5>
                <p>Validez la transaction après l'échange dans la section <img src="{{ url('images/transactions.png') }}" class="inline-block w-12 h-12"/> pour finaliser le troc.</p>
            </div>
        </div>
    </div>
</div>

@if ($bothBannersShown || $onlyLeftBannerShown || $onlyRightBannerShown)
    <div class="flex justify-center bg-primary-color text-white" style="height: 25vh;">
@else
    <div class="flex flex-wrap md:flex-nowrap justify-center space-x-4 md:space-x-20 text-white mx-4 md:mx-24" style="height: 25vh;">
@endif
    <div class="flex items-center bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
        <div class="text-blue-500 mr-4">
            <i class="fa fa-cube fa-2x"></i>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl font-semibold text-gray-800">{{ count($offers) }}+</div>
            <div class="text-sm text-gray-500">Annonces</div>
        </div>
    </div>
    <div class="flex items-center bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
        <div class="text-green-500 mr-4">
            <i class="fa fa-users fa-2x"></i>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl font-semibold text-gray-800">{{ count($users) }}+</div>
            <div class="text-sm text-gray-500">Utilisateurs</div>
        </div>
    </div>
    <div class="flex items-center bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
        <div class="text-red-500 mr-4">
            <i class="fa fa-handshake fa-2x"></i>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl font-semibold text-gray-800">{{ count($transactions) }}+</div>
            <div class="text-sm text-gray-500">Transactions</div>
        </div>
    </div>
    <div class="flex items-center bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
        <div class="text-purple-500 mr-4">
            <i class="fa fa-map-marker-alt fa-2x"></i>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl font-semibold text-gray-800">{{ count($regions) }}+</div>
            <div class="text-sm text-gray-500">Regions</div>
        </div>
    </div>
</div>

<div id="description-website" class="flex flex-col my-12 mx-2 md:mx-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Image et texte 1 -->
        <div class="flex items-center space-x-4">
            <div class="w-24 h-24 relative flex-shrink-0">
                <img src="{{ asset('images/add.jpg') }}" class="w-full h-full object-cover rounded-full shadow-lg" alt="Description 1"/>
            </div>
            <div class="flex flex-col">
                <div class="text-xl font-semibold mb-1">Créer un monde meilleur</div>
                <p class="text-sm">Échangez vos affaires pour un avenir plus durable.</p>
            </div>
        </div>

        <!-- Image et texte 2 -->
        <div class="flex items-center space-x-4">
            <div class="w-24 h-24 relative flex-shrink-0">
                <img src="{{ asset('images/abcd.jpg') }}" class="w-full h-full object-cover rounded-full shadow-lg" alt="Description 2"/>
            </div>
            <div class="flex flex-col">
                <div class="text-xl font-semibold mb-1">Favoriser la solidarité</div>
                <p class="text-sm">Encouragez les contacts sociaux à travers le troc.</p>
            </div>
        </div>

        <!-- Image et texte 3 -->
        <div class="flex items-center space-x-4">
            <div class="w-24 h-24 relative flex-shrink-0">
                <img src="{{ asset('images/af.jpg') }}" class="w-full h-full object-cover rounded-full shadow-lg" alt="Description 3"/>
            </div>
            <div class="flex flex-col">
                <div class="text-xl font-semibold mb-1">Échanger des services</div>
                <p class="text-sm">Découvrez un site complet pour échanger services et biens.</p>
            </div>
        </div>
    </div>
</div>



<div id="newsletter-container" class="flex justify-center space-x-4 md:space-x-20 text-white ml-2 mr-2 md:ml-24 md:mr-24 rounded p-2 md:p-8">
    <div class="hidden md:block w-2/5">
        <!-- Titre et paragraphe cachés sur mobile -->
    </div>
    <form method="POST" action="{{route('newsletters.addEmail')}}">
        @csrf
        <h2 class="mb-4 text-2xl tracking-tight font-medium sm:text-4xl dark:text-white">Abonnez vous à notre newsletter</h2>
        <p class="max-w-2xl font-light sm:text-sm dark:text-gray-400">Inscrivez vous à notre newsletter pour recevoir nos offres et promotions</p>
        <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
            <div class="relative w-full">
                <label for="email" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/1000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                </div>
                <input class="block z-10 py-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="entrer votre Email" type="email" id="email" name="email" required="">
            </div>
            <button type="submit" class="m-2 p-2 w-full text-sm font-medium text-center  rounded border cursor-pointer bg-primary-color border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">s'abonner</button>
        </div>
        <div class="mx-auto max-w-screen-sm text-sm text-left newsletter-form-footer dark:text-gray-300">Nous nous soucions de la protection de vos données. 
            <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Lisez notre politique de confidentialité</a>.</div>
    </form>
</div>
                            @foreach ($banners as $banner)
        @if ($banner->is_active && ($banner->page === 'home' || $banner->page ==='all') && $banner->position === 'bottom')
        <div class="flex justify-center mt-4">
        <a href="{{$banner->description}}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:820px;height:70px;">
</a>
        </div>
            @endif
    @endforeach
    </div>
     <div id="footer-create-add-button" >
                <a class="" href="{{ route('offer.create') }}">
                    <div class="footer-create-add-button-img">
                        <img src="{{ asset('images/plus-icon-white.svg') }}" alt="" />
                    </div>
                    <span class="footer-create-add-button-span">
                        Déposer <br />
                        une annonce
                    </span>
                </a>
            </div>

</x-app-layout>

<style>

.text{
	font-family: 'arial black';
	font-size: 60px;
	text-align: center;
	padding: 0;
	margin: 0;
	margin-left: 50%;
	transform: translateX(-200%);
	opacity: 0;
	animation: slide-in-anim 1.5s ease-out forwards;
}

@keyframes slide-in-anim {
	20% {
		opacity: 0;
	}
	60% {
		transform: translateX(-45%);
	}
	75% {
		transform: translateX(-52%);
	}
	100% {
		opacity: 1;
		transform: translateX(-50%);
	}
}

.brightness { filter: brightness(0.25); }
/* Additional styles for the new content */
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto  ;
  grid-row-gap: 30px;
  grid-column-gap: 30px;
  padding: 100px;
}
.s{
  border : 0.5px solid black;
  padding-top:15px ;
}

.title {
    color: var(--titles-color);
    margin-top: 50px;
}
.titlee {
    color: #ffff;
    margin-top: 16px;
}

.title h1 {
    color: var(--secondary-color);
}

.call-action {
    margin-top: 10px;
}

.sg-btn {
    display: inline-block;
    padding: 10px 20px;
    color: black;
    text-decoration: none;
    background-color: var(--primary-color-hover);
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 30px;
}

.sg-btn:hover {
    background-color: white;
}
.bg-primary-color{
    background-color: var(--primary-color);
}

.more-btn {
    display: inline-block;
    padding: 7px 10px;
    background-color: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    transition: background-color 0.3s ease;
    font-size: 24px;
}

.more-btn:hover {
    background-color: var(--primary-color-hover);
}
 .custom-section {
      
      border-color: red;
      border: solid;
    }
    
    .user-item {
    display: flex;
    margin-bottom: 15px;
}

.media {
    margin-right: 15px; /* Adjust the spacing between the avatar and user details */
}

.details {
    flex-grow: 1; /* This will make the details take up the remaining space */
}

.offer-count {
    font-size: 14px; /* Adjust the font size of the offer count */
}
#newsletter-container {
  background-color: #f9f9f9;
  padding: 2rem;
  border-radius: 1rem;
  margin: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#newsletter-container h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #333;
}

#newsletter-container p {
  font-size: 1.5rem;
  margin-bottom: 2rem;
  color: #666;
}

#newsletter-container .form-group {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 1rem;
}

#newsletter-container label {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 0.5rem;
}

#newsletter-container input[type="email"] {
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 0.5rem;
  width: 100%;
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 1rem;
}

#newsletter-container button[type="submit"] {
  padding: 1rem 2rem;
  border: none;
  border-radius: 0.5rem;
  font-size: 1.5rem;
  color: #fff;
  background-color: #8BC34A;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#newsletter-container button[type="submit"]:hover {
  background-color: #689F38;
}

#newsletter-container .input-group {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 1rem;
}

#newsletter-container .input-group input[type="email"] {
  width: 70%;
  margin-right: 1rem;
}

#newsletter-container .input-group button[type="submit"] {
  width: 30%;
}

#description-website > .flex:nth-child(even) > .image{
    order:3;
}
#description-website > .flex:nth-child(even) > .flex{
    order:1;
}
#description-website > .flex:nth-child(even) > .div{
    order:2;
}
#description-website > .flex:nth-child(even) > .flex{
    order:1;
}
.owl-carousel,.owl-carousel .owl-item {
    -webkit-tap-highlight-color: transparent;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
    position: relative
}

.owl-carousel {
    display: none;
    width: 100%;
    z-index: 1
}

.owl-carousel .owl-stage {
    position: relative;
    -ms-touch-action: pan-Y;
    touch-action: manipulation;
    -moz-backface-visibility: hidden
}

.owl-carousel .owl-stage:after {
    content: ".";
    display: flex;
    clear: both;
    visibility: hidden;
    line-height: 0;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;"
    height: 0
}

.owl-carousel .owl-stage-outer {
    position: relative;
    -webkit-transform: translate3d(0,0,0)
}

.owl-carousel .owl-item,.owl-carousel .owl-wrapper {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -webkit-transform: translate3d(0,0,0);
    -moz-transform: translate3d(0,0,0);
    -ms-transform: translate3d(0,0,0)
}

.owl-carousel .owl-item {
    min-height: 1px;
    float: left;
    -webkit-backface-visibility: hidden;
    -webkit-touch-callout: none
}

.owl-carousel .owl-item img {
    display: flex;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
    
}

.owl-carousel .owl-dots.disabled,.owl-carousel .owl-nav.disabled {
    display: none
}

.no-js .owl-carousel,.owl-carousel.owl-loaded {
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;}

.owl-carousel .owl-dot,.owl-carousel .owl-nav .owl-next,.owl-carousel .owl-nav .owl-prev {
    cursor: pointer;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

.owl-carousel .owl-nav button.owl-next,.owl-carousel .owl-nav button.owl-prev,.owl-carousel button.owl-dot {
    background: 0 0;
    color: inherit;
    border: none;
    padding: 0!important;
    font: inherit
}

.owl-carousel.owl-loading {
    opacity: 0;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
}

.owl-carousel.owl-hidden {
    opacity: 0
}

.owl-carousel.owl-refresh .owl-item {
    visibility: hidden
}

.owl-carousel.owl-drag .owl-item {
    -ms-touch-action: pan-y;
    touch-action: pan-y;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

.owl-carousel.owl-grab {
    cursor: move;
    cursor: grab
}

.owl-carousel.owl-rtl {
    direction: rtl
}

.owl-carousel.owl-rtl .owl-item {
    float: right
}

.owl-carousel .animated {
    animation-duration: 1s;
    animation-fill-mode: both
}

.owl-carousel .owl-animated-in {
    z-index: 0
}

.owl-carousel .owl-animated-out {
    z-index: 1
}

.owl-carousel .fadeOut {
    animation-name: fadeOut
}

@keyframes fadeOut {
    0% {
        opacity: 1
    }

    100% {
        opacity: 0
    }
}

.owl-height {
    transition: height .5s ease-in-out
}

.owl-carousel .owl-item .owl-lazy {
    opacity: 0;
    transition: opacity .4s ease
}

.owl-carousel .owl-item .owl-lazy:not([src]),.owl-carousel .owl-item .owl-lazy[src^=""] {
    max-height: 0
}

.owl-carousel .owl-item img.owl-lazy {
    transform-style: preserve-3d
}

.owl-carousel .owl-video-wrapper {
    position: relative;
    height: 100%;
    background: #000
}

.owl-carousel .owl-video-play-icon {
    position: absolute;
    height: 80px;
    width: 80px;
    left: 50%;
    top: 50%;
    margin-left: -40px;
    margin-top: -40px;
    background: url(owl.video.play.png) no-repeat;
    cursor: pointer;
    z-index: 1;
    -webkit-backface-visibility: hidden;
    transition: transform .1s ease
}

.owl-carousel .owl-video-play-icon:hover {
    -ms-transform: scale(1.3,1.3);
    transform: scale(1.3,1.3)
}

.owl-carousel .owl-video-playing .owl-video-play-icon,.owl-carousel .owl-video-playing .owl-video-tn {
    display: none
}

.owl-carousel .owl-video-tn {
    opacity: 0;
    height: 100%;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    transition: opacity .4s ease
}

.owl-carousel .owl-video-frame {
    position: relative;
    z-index: 1;
    height: 100%;
    width: 100%
}


.owl-carousel .nav-btn{
  height: 47px;
  position: absolute;
  width: 26px;
  cursor: pointer;
  top: 100px !important;
}

.owl-carousel .owl-prev.disabled,
.owl-carousel .owl-next.disabled{
pointer-events: none;
opacity: 0.2;
}

.owl-carousel .prev-slide{
  background: url(nav-icon.png) no-repeat scroll 0 0;
  left: -33px;
}
.owl-carousel .next-slide{
  background: url(nav-icon.png) no-repeat scroll -24px 0px;
  right: -33px;
}
.owl-carousel .prev-slide:hover{
 background-position: 0px -53px;
}
.owl-carousel .next-slide:hover{
background-position: -24px -53px;
}  
</style>
<style>
    #catcarousel,#catcarousel.owl-item {
    -webkit-tap-highlight-color: transparent;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
    position: relative
}

#catcarousel {
    display: none;
    
    z-index: 1
}

#catcarousel .owl-stage {
    position: relative;
    -ms-touch-action: pan-Y;
    touch-action: manipulation;
    -moz-backface-visibility: hidden
}

#catcarousel .owl-stage:after {
    content: ".";
    display: flex;
    clear: both;
    visibility: hidden;
    line-height: 0;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;"
    height: 0
}

#catcarousel .owl-stage-outer {
    position: relative;
    -webkit-transform: translate3d(0,0,0)
}

#catcarousel .owl-item,#catcarousel .owl-wrapper {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -webkit-transform: translate3d(0,0,0);
    -moz-transform: translate3d(0,0,0);
    -ms-transform: translate3d(0,0,0)
}

#catcarousel .owl-item {
    min-height: 1px;
    float: left;
    -webkit-backface-visibility: hidden;
    -webkit-touch-callout: none
}

#catcarousel .owl-item img {
    display: flex;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
    
}

#catcarousel .owl-dots.disabled,#catcarousel .owl-nav.disabled {
    display: none
}

.no-js #catcarousel,#catcarousel.owl-loaded {
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;}

    #catcarousel .owl-dot,#catcarousel.owl-nav .owl-next,#catcarousel .owl-nav .owl-prev {
    cursor: pointer;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

#catcarousel .owl-nav button.owl-next,#catcarousel .owl-nav button.owl-prev,#catcarousel button.owl-dot {
    background: 0 0;
    color: inherit;
    border: none;
    padding: 0!important;
    font: inherit
}

#catcarousel.owl-loading {
    opacity: 0;
    display:flex !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
}

#catcarousel.owl-hidden {
    opacity: 0
}

#catcarousel.owl-refresh .owl-item {
    visibility: hidden
}

.owl-carousel.owl-drag .owl-item {
    -ms-touch-action: pan-y;
    touch-action: pan-y;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

#catcarousel.owl-grab {
    cursor: move;
    cursor: grab
}

#catcarousel.owl-rtl {
    direction: rtl
}

#catcarousel.owl-rtl .owl-item {
    float: right
}

#catcarousel .animated {
    animation-duration: 1s;
    animation-fill-mode: both
}

#catcarousel .owl-animated-in {
    z-index: 0
}

#catcarousel .owl-animated-out {
    z-index: 1
}

#catcarousel .fadeOut {
    animation-name: fadeOut
}

@keyframes fadeOut {
    0% {
        opacity: 1
    }

    100% {
        opacity: 0
    }
}

.owl-height {
    transition: height .5s ease-in-out
}

#catcarousel .owl-item .owl-lazy {
    opacity: 0;
    transition: opacity .4s ease
}

#catcarousel .owl-item .owl-lazy:not([src]),#catcarousel .owl-item .owl-lazy[src^=""] {
    max-height: 0
}

#catcarousel .owl-item img.owl-lazy {
    transform-style: preserve-3d
}

#catcarousel .owl-video-wrapper {
    position: relative;
    height: 100%;
    background: #000
}

#catcarousel .owl-video-play-icon {
    position: absolute;
    height: 80px;
    width: 80px;
    left: 50%;
    top: 50%;
    margin-left: -40px;
    margin-top: -40px;
    background: url(owl.video.play.png) no-repeat;
    cursor: pointer;
    z-index: 1;
    -webkit-backface-visibility: hidden;
    transition: transform .1s ease
}

#catcarousel .owl-video-play-icon:hover {
    -ms-transform: scale(1.3,1.3);
    transform: scale(1.3,1.3)
}

#catcarousel .owl-video-playing .owl-video-play-icon,#catcarousel .owl-video-playing .owl-video-tn {
    display: none
}

#catcarousel .owl-video-tn {
    opacity: 0;
    height: 100%;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    transition: opacity .4s ease
}

#catcarousel .owl-video-frame {
    position: relative;
    z-index: 1;
    height: 100%;
    width: 100%
}
.swiper-slide{
    margin-right:0px !important;
}
#slide3{
    width:1427px !important; 
}
#slide2{
    width:1387px !important; 
}
.swiper {
      width: 100%;
      height: 100%;
    }
.swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
  overflow: hidden;
  z-index: 1;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .swiper-pagination-bullet{
        background-color:#24A19C !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
<script>
    $(document).ready(function () {
        let all = document.getElementsByClassName("zoomD"),
        lightbox = document.getElementById("lightbox");
        owl = $(".owl-carousel");
  owl.owlCarousel({
      loop:true,
      autoplayTimeout:2000,
      items:3,
      autoplay:true, 
      responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:true
        }
    }
      

  });
    
  $('.owl-carousel__next').click(() => owl.trigger('next.owl.carousel'));
  
  $('.owl-carousel__prev').click(() => owl.trigger('prev.owl.carousel'));
  owlcat = $("#catcarousel");
  owlcat.owlCarousel({
      loop:true,
      autoplayTimeout:2000,
      items:6,
      autoplay:true,
      responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:true
        }
    }
  });
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
        //
        $(window).scroll(function() {
            var scrollPosition = $(window).scrollTop();
            var left = $('#left');
            var right = $('#right');

            if (scrollPosition > 250) {
                left.css('top', '80px');
                right.css('top', '80px');
                right.css('margin-top', '0px');
            } else {
            left.css('top', '');
            right.css('margin-top', '260px');

        }}); 
// 
      
        

    });
</script>
<style>
    .background-image {
    background-image: url('{{ asset('images/ab.png') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    padding: 2rem;
    }
</style>
 
