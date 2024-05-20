<x-app-layout>
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
       <div >
           <h1 class="titlee">Avez-vous un bien ou un service ?<br>cherchez, postez et <span style="font-size: 41px;font-weight: 800;color:#24a19c;" >troquez</span>  !</h1>
           <div class="mt-12 d-flex align-items-center justify-content-center" >
               <a class="sg-btn" href="{{route('alloffers.index')}}">Consultez nos offres <i class="pl-2 fa fa-long-arrow-right"></i></a>
           </div>
       </div>
    </div>
    <h1 class="titlee text-center font-bold">Ne perdez plus votre temps et rejoignez notre réseau de <span style="font-size: 41px;font-weight: 800;color:#24a19c;">troqueurs </span> !</h1>

    </div>  

    <div class="swiper-wrapper" >

      <div class="swiper-slide">  <img  class="brightness" src="https://www.nowteam.net/wp-content/uploads/2021/01/AdobeStock_283137103-1080x675.jpeg" alt=""  >   </div>
      <div class="swiper-slide"><img  class="brightness" src="https://www.londonlibrary.co.uk/images/CHARLOTTE/NEW_WEBSITE_IMAGES/LF_Wide_Back_Stacks.jpg" alt="" ></div>
      <div class="swiper-slide"><img  class="brightness" src="https://static.vecteezy.com/system/resources/previews/024/903/858/non_2x/beautiful-women-in-fashionable-clothing-exude-elegance-generated-by-ai-free-photo.jpg" alt="" ></div>
      
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

    <div id="catcarousel" class="grid grid-cols-3 md:grid-cols-6 justify-content place-items-stretch center my-4 ml-2 mr-2 md:mr-32 md:ml-32 ">
        @for($i=0; $i< min(12,count($categories)) ;$i++ )
        <a class="no-underline text-black block" href="{{route('alloffers.index',['category'=> $categories[$i]->id])}}">
            <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
                <div class="bg-slate-100 rounded-full p-1 aspect-square"><i class="fa {{$categories[$i]['icon']}}"></i></div>
                <div class="font-semibold pl-2">{{$categories[$i]->name}}</div>
                <div class="text-sm">{{$categories[$i]->children->reduce(function($carry,$sub){return $carry+$sub->offer->where('active_offer', 1)->where('launch_date', null)->count();})}} Offres</div>
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
                <i class="pl-2 fa fa-long-arrow-left"></i>
                <i class="pl-2 fa fa-long-arrow-right"></i>
            </div>

        </div>
        <div id="featured-offers-container"  class="owl-carousel owl-six" data-inner-pagination="true" data-white-pagination="true" data-nav="false" data-autoPlay="true">

        @for ($i=0;$i<count($featuredOffers);$i++)
            <div class=" grow-0 shrink-0 @if($i>0) @endif" style="width: 100%;">
                <x-offer-present-card :offer=$featuredOffers[$i]></x-offer-present-card>
            </div>
            @endfor
        </div>
        </div>


        
        @if(count($featuredOffers)>3)
        <div class="col-span-full d-flex items-center justify-end">
            <a class="more-btn" style="font-size:14px;margin:0" href="{{route('alloffers.index')}}">Voir plus<i class="pl-2 fa fa-long-arrow-right"></i></a>
        </div>
        @endif
    </div>

    <div id="recent-offers" class="flex flex-col my-4 ml-2 mr-2 md:mr-24 md:ml-24 pb-12">
        <div id="recent-offers-title" class="flex justify-between">
            <h4>Plus récentes</h4>
            <div class="flex">
                <i class="pl-2 fa fa-long-arrow-left"></i>
                <i class="pl-2 fa fa-long-arrow-right"></i>
            </div>

        </div>
        <div id="recent-offers-container" class="owl-carousel owl-six" data-inner-pagination="true" data-white-pagination="true" data-nav="false" data-autoPlay="true">
            @for ($i=0;$i<count($recentOffers);$i++)
            <div class=" grow-0 shrink-0 @if($i>0) @endif" style="width: 100%;">
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

    <div class="flex flex-col justify-center space-y-10 bg-slate-100 pb-12" style='background:#343a40 url("https://www.faistroquer.fr/public/img/bg-counters.png");' >
        <h1 class="text-center mt-12" style ="color:white" >Comment ca marche?</h1>
        <h4 class="text-center"style ="color:white" >Deposer une annonce</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mx-16 my-2">
            <div class="flex-1 p-4 " style="background-color:#00000060">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list " style ="color:white"></i>
                    <span style ="color:white" class="text-5xl font-sans font-thin">01</span>
                </div>
                <h5 style ="color:white">Créer un compte</h5>
                <p style ="color:white" >
                Pour créer un compte, appuyez simplement sur le bouton "S'authentifier" en haut : <img src="{{ asset('images/header.png') }}"/> et choisissez l'option "S'enregistrer".
                Ajoutez vos informations essentielles pour finaliser le processus d'inscription.
                </p>
            </div>
            <div class="flex-1 p-4 "style="background-color:#00000060">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list " style ="color:white"></i>
                    <span class="text-5xl font-sans font-thin"style ="color:white" >02</span>
                </div>
                <h5 style ="color:white">Deposer une annonce</h5>
                <p style ="color:white" >
                    Une fois votre compte créé, rendez-vous sur la rubrique <img  src="{{ asset('images/add_offer.png') }}"/>
                    Remplissez le formulaire en indiquant les détails de votre offre.
                    Choisissez votre troc en précisant contre quoi vous souhaitez échanger.<br>
                    Facultatif : activez un compte à rebours pour une touche d'urgence.
                    Choisissez entre un dépôt d'annonce immédiat ou différé.
                    Validez en cliquant sur "Déposer un troc" ou en appuyant sur la touche entrée.
                </p>
            </div>
            <div class="flex-1 p-4 " style="background-color:#00000060">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list " style ="color:white"></i>
                    <span class="text-5xl font-sans font-thin"style ="color:white" >03</span>
                </div>
                <h5 style ="color:white">Obtenir des propositions</h5>
                <p style ="color:white">
                Une fois votre annonce publiée, attendez de recevoir des propositions d'autres membres.
            Pour maximiser vos chances d'être contacté, activez l'option "Étudie toutes propositions" en plus des autres détails de trocs que vous avez indiqués.
            Communiquez et négociez avec les autres membres via les messages.
            Choisissez ensuite une date de rendez-vous pour finaliser l'échange.
                </p>
            </div>
            </div>   

        </div>   
         <div class="flex flex-col justify-center space-y-10 bg-slate-100 pb-12" style='background-image:url("");' >


        <h4 class="text-center">Faire un troc</h4>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mx-16 my-2">
        <div class="flex-1 border bg-white p-4 ">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list "></i>
                    <span class="text-5xl font-sans font-thin">01</span>
                </div>
                <h5>Créer un compte</h5>
                <p>
                    
                </p>
            </div>
            <div class="flex-1 border bg-white p-4 ">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list "></i>
                    <span class="text-5xl font-sans font-thin">02</span>
                </div>
                <h5>Envoyer une proposition</h5>
                <p>
                Explorez les offres en utilisant des filtres ou la recherche. Sélectionnez une offre et appuyez sur "Troquer maintenant" pour proposer un échange. Remplissez le formulaire, puis validez pour soumettre votre proposition à l'auteur de l'offre, qui pourra examiner, accepter, rejeter, ou négocier davantage.
        
                </p>
            </div>
            <div class="flex-1 border bg-white p-4 ">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list "></i>
                    <span class="text-5xl font-sans font-thin">03</span>
                </div>
                <h5>Obtenir l'acceptation</h5>
                <p>
                Une fois que la proposition est acceptée, vous pouvez convenir d'un rendez-vous avec l'offreur ou entamer une discussion via le chat (messagerie).
                </p>
            </div>
            <div class="flex-1 border bg-white p-4 ">
                <div class="flex justify-between items-center">
                    <i class="fa fa-list "></i>
                    <span class="text-5xl font-sans font-thin">04</span>
                </div>
                <h5>Effectuer l'echange</h5>
                <p>
                Quand la proposition est acceptée, une transaction apparaîtra dans la section <img src="{{ asset('images/transactions.png') }}"/>  avec le statut "En cours". Après l'échange, vous devrez valider la transaction pour qu'elle soit comptabilisée comme un troc réalisé dans votre com
                </p>
            </div>
        
        </div>
    </div>
@if ($bothBannersShown || $onlyLeftBannerShown || $onlyRightBannerShown)
<div class="flex justify-center  bg-primary-color text-white " style="height:25vh" >
@else
<div class="flex flex-wrap md:flex-no-wrap justify-center space-x-4 md:space-x-20 bg-primary-color text-white ml-0 mr-0 md:ml-24 md:mr-24" style="height:25vh" >
    @endif
        <div class="flex items-center">
            <div class="m-3"><i class="fa fa-cube fa-2x"></i></div>
            <div class="flex flex-col justify-center items-center space-y-1">
                <div class="text-lg font-meduim">{{count($offers)}}+</div>
                <div class="text-xs">Annonces</div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="m-3"><i class="fa fa-users fa-2x"></i></div>
            <div class="flex flex-col justify-center items-center space-y-1">
                <div class="text-lg font-meduim">{{count($users)}}+</div>
                <div class="text-xs">Utilisateurs</div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="m-3"><i class="fa fa-handshake fa-2x"></i></div>
            <div class="flex flex-col justify-center items-center space-y-1">
                <div class="text-lg font-meduim">{{count($transactions)}}+</div>
                <div class="text-xs">Transactions</div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="m-3"><i class="fa fa-map-marker-alt fa-2x"></i></div>
            <div class="flex flex-col justify-center items-center space-y-1">
                <div class="text-lg font-meduim">{{count($regions)}}+</div>
                <div class="text-xs">Regions</div>
            </div>
        </div>
    </div>

    <div id="description-website" class="flex flex-col justify-center space-y-20 my-12 ml-2 mr-2 md:ml-24 md:mr-24">
        <div class="flex items-center">
            <div class="image" style="height:35%;width:40%"><img src="{{ asset('storage/Home/Avantage-troc.jpg') }}"/></div>
            <div class="div" style="width:10%"></div>
            <div style="width:40%"class="flex flex-col justify-start items-start space-y-3">
                <div class="text-2xl font-meduim">Echanger ses affaires pour creer un monde meilleur</div>
                <div class="text-sm">
                   
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="image" style="height:35%;width:40%"><img src="{{ asset('storage/Home/comportement-troqueur.jpg') }}"/></div>
            <div class="div" style="width:10%"></div>
            <div style="width:40%" class="flex flex-col justify-start items-start space-y-3">
                <div class="text-2xl font-meduim">Troquer pour favoriser la solidarité et les contacts sociaux</div>
                <div class="text-sm">
                   
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <div class="image" style="height:35%;width:40%"><img src="{{ asset('storage/Home/troqueur.jpg') }}"/></div>
            <div class="div" style="width:10%"></div>
            <div style="width:40%" class="flex flex-col justify-start items-start space-y-3">
                <div class="text-2xl font-meduim">Ici c'est aussi un site d'echange de services et bien plus encore</div>
                <div class="text-sm">
                    
                </div>
            </div>
        </div>
    </div>

    <div id="newsletter-container" class="flex justify-center space-x-4 md:space-x-20 bg-primary-color text-white ml-2 mr-2 md:ml-24 md:mr-24 rounded p-2 md:p-8">
        <div class="hidden md:block w-2/5">
            <h2 class="mb-4 text-2xl tracking-tight font-medium sm:text-4xl dark:text-white">Abonnez vous à notre newsletter</h2>
            <p class="mx-auto max-w-2xl font-light sm:text-sm dark:text-gray-400">Inscrivez vous à notre newsletter pour recevoir nos offres et promotions</p>
        </div>
        <form method="POST" action="{{route('newsletters.addEmail')}}">
            <h2 class="mb-4 block md:hidden text-2xl tracking-tight font-medium sm:text-4xl dark:text-white">Abonnez vous à notre newsletter</h2>
            @csrf
            <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/1000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    </div>
                    <input class="block z-10 py-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter your email" type="email" id="email" name="email" required="">
                    <div class="flex absolute z-[1000] inset-y-0 right-0 items-center pl-3 ">
                        <button type="submit" class="m-2 p-2 w-full text-sm font-medium text-center  rounded border cursor-pointer bg-primary-color border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Subscribe</button>
                    </div>
                </div>
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
    margin-top: 50px;
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
    background-color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 24px;
}

.sg-btn:hover {
    background-color: var(--primary-color-hover);
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
#newsletter-container{
    background: -webkit-radial-gradient(40% 50%, circle closest-side, var(--primary-color-hover) 100% 0, var(--primary-color-hover) 100% 99%, var(--primary-color-hover) 0% 100%), var(--primary-color);
  background: -moz-radial-gradient(40% 50%, circle closest-side, var(--primary-color-hover) 100% 0, var(--primary-color-hover) 100% 99%, var(--primary-color-hover) 0% 100%), var(--primary-color);
  background: radial-gradient(circle closest-side at 40% 50%, var(--primary-color-hover) 100% 0, var(--primary-color-hover) 100% 99%, var(--primary-color) 0% 100%), var(--primary-color);//center of cercle
  background-repeat: no-repeat;
  background-position: 45% 50%;//Position on the big background
  -webkit-background-origin: padding-box;
  background-origin: padding-box;
  -webkit-background-clip: border-box;
  background-clip: border-box;
  -webkit-background-size: 400% 400%;
  background-size: 400% 400%;//Size to define big background
    //The goal is to be a position where we can see the desired portion of circle on the big background

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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;"
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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;}

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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
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
}

@media only screen and (max-width: 600px) {
  .owl-carousel {
    height: 110px; 
    width: 100%; 
   }
  .owl-carousel .owl-carousel-cell {
     height: 100%; 
     width: 40%; 
     margin-right: 2%;
   }
   
}
</style>
<style>
    #catcarousel,#catcarousel.owl-item {
    -webkit-tap-highlight-color: transparent;
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;"
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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;}

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
    display:flex !important;margin-bottom: 1.5rem !important;flex-wrap: nowrap !important;overflow-x: hidden !important;gap: 20px !important;padding:10px !important;
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
      autoplay:true
  });
  owlcat = $("#catcarousel");
  owlcat.owlCarousel({
      loop:true,
      autoplayTimeout:2000,
      items:6,
      autoplay:true
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
        ['featured','recent'].forEach((el)=>{
            if ($('#offers-container .basis-1\\/3').length > 0){
                var scrollDistance = $(`#${el}-offers-container`).width()/3;
            }else{
                var scrollDistance = $(`#${el}-offers-container`).width();
            }
            $(`#${el}-offers-title .fa-long-arrow-right`).css(`-webkit-text-stroke`," 2px");
            
            $(`#${el}-offers-title .fa-long-arrow-left`).click(function () {
                $(`#${el}-offers-container`).animate({scrollLeft: "-=" + scrollDistance}, "slow");
                if($(`#${el}-offers-container`).scrollLeft() > 0)
                $(`#${el}-offers-title .fa-long-arrow-left`).css("-webkit-text-stroke"," 2px");
                else            
                $(`#${el}-offers-title .fa-long-arrow-left`).css("-webkit-text-stroke"," 0.5px");
            });
            
            $(`#${el}-offers-title .fa-long-arrow-right`).click(function () {
                $(`#${el}-offers-container`).animate({scrollLeft: "+=" + scrollDistance}, "slow");
                if($(`#${el}-offers-container`).scrollLeft() < $(`#${el}-offers-container`).prop("scrollWidth") - $(`#${el}-offers-container`).width())
                $(`#${el}-offers-title .fa-long-arrow-right`).css("-webkit-text-stroke"," 2px");
                else            
                $(`#${el}-offers-title .fa-long-arrow-right`).css("-webkit-text-stroke"," 0.5px");
            });
        });
        

    });
</script>
