@props(['parentcategories'])
<header id="main-header" wire:poll.30000ms="refreshData">
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    /* The slider */
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #24A19C;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #24A19C;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
<!--  -->
        <div class="h-container overflow-x-scroll">
            <div id="header-logo" class="">
                <a href="{{ route('home') }}">
                    <img src="{{asset('images/logo-faistroquerfr.svg')}}" alt="Logo faistroquer.fr" class="logo-desktop" />
                    <img src="{{asset('images/logo-mobile.svg')}}" alt="Logo faistroquer.fr" class="logo-mobile" />
                </a>
            </div>
            <div id="header-categories-button">
                <button
                    id="header-categories-button-btn"
                    class="header-categories-button-button">
                        <img
                        style="min-width:15px"
                            src="{{ asset('images/list-icon-24.svg') }} "
                            alt=""
                            id="header-categories-button-button-icon" />
                        <span class="header-categories-button-button-span">Categories</span>
                </button>
            </div>
            <div id="header-search">
                <form action="{{ request()->is('offer.*') ? route('offer.index') : route('alloffers.index') }}" method="GET">
                    <button type="button" id="header-search-location-btn">
                        <img id="region-icon" src="{{ asset('images/location-icon.svg') }} " alt="Localisation" />
                    </button>
                    <input id="header-search-input" type="search" name="query" placeholder="Rechercher une offre..." />
                    @if(request()->has('region'))
                        <input type="hidden" name="region" value="{{ request('region') }}">
                    @endif
                    <button id="header-search-submit" type="submit">
                        <img src="{{ asset('images/search-icon.svg') }}" alt="Recherche" />
                    </button>
                </form>

                <button id="header-search-icon-mobile">
                    <img src="{{asset('images/search-icon-dark.svg')}}" alt="" />
                </button>
            </div>
            <div id="header-filter">
                <button id="header-filter-button-btn">
                    <img src="{{asset('images/filter-icon.svg')}}" alt="" />
                    <span>Filtre</span>
                </button>
            </div>
            <div >
                <a class="header-user-avatar-dropdown-item" href="{{ route('blog.index') }}"style="color:#24A19C;font-weight: 900">
                    <span >BLOG</span>
                </a>
            </div>
            <div id="header-user">
                @auth
                <!-- Authenticated User -->
                <div id="header-authenticated-user" class="gap-2">
                    <div class="dropdown" class="header-authenticated-user-content">
                        <div id="header-user-notification-icon" class="" data-bs-toggle="dropdown" aria-expanded="false">
                            <div>
                                @if(count($notifications)==0)
                                <div class="header-user-notification-icon"></div>
                                @else
                                <div class="header-user-notification-icon-notified"></div>
                                @endif
                            </div>

                        </div>
                        <ul class="dropdown-menu notification-dropdown overflow-auto" style="max-height:60vh">
                            @if(count($notifications)==0)
                            <li>
                                <div class="notification-dropdown-item">
                                    <div class="notification-dropdown-item-content">
                                    <b>Vous n'avez aucune nouvelle notification</b>
                                    </div>
                                </div>
                            </li>
                            @else
                            @foreach ($notifications as $notification)
                            <li>
                                <div class="notification-dropdown-item @if($notification->read_at==NULL) bg-gray-800 hover:bg-gray-600 @endif">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content" wire:click="read('{{$notification->id}}')">
                                        <a >
                                            <b>{{$notification?->data["name"] ?? null}}</b>
                                            <span>{{$notification->data["content"] ?? null}}</span>
                                            <strong>{{$notification->data["title"] ?? null}}</strong>
                                        </a>
                                        <button class="notification-delete-icon" data-notification-id="{{$notification->id}}">🗑️</button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        
                    </div>
                    <div class="dropdown" class="header-authenticated-user-content">
                        <div id="header-user-messages-icon" class="" data-bs-toggle="dropdown" aria-expanded="false">
                            <div wire:click="read(1)">
                                @if(count($messages->where('read_at',NULL))==0)
                                <div class="header-user-messages-icon"></div>
                                @else
                                <div class="header-user-messages-icon-newmessages"></div>
                                @endif
                            </div>
                        </div>
                        <ul class="dropdown-menu notification-dropdown overflow-auto" style="max-height:60vh">
                            @if(count($messages)==0)
                            <li>
                                <div class="notification-dropdown-item">
                                    <div class="notification-dropdown-item-content">
                                    <b>Vous n'avez aucun nouveau message</b>
                                    </div>
                                </div>
                            </li>
                            @else
                            @foreach ($messages as $notification)
                            <li>
                                <div class="notification-dropdown-item @if($notification->read_at==NULL) bg-gray-800 hover:bg-gray-600 @endif">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content" wire:click="read('{{$notification->id}}')">
                                        <a >
                                            <b>{{$notification->data["name"]}}</b>
                                            <span>{{$notification->data["content"]}}</span>
                                            <strong>{{$notification->data["from_id"]}}</strong>
                                        </a>
                                        <div wire:click="delete('{{$notification->id}}')">
                                            <button class="notification-delete-icon">🗑️</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div id="header-user-avatar-icon" class="">
                        <div class="" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (isset($user->profile_photo_path))
                            <img src="{{route('profile_pictures-file-path',$user->profile_photo_path)}}" alt="" class="header-user-avatar-icon-img rounded-full" />
                            @else 
                            <img src="{{route('profile_pictures-file-path',$user->avatar)}}" alt="" class="header-user-avatar-icon-img rounded-full" />
                            @endif
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end header-user-avatar-dropdown">
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('myaccount.index')}}">
                                    <img src="{{asset('images/user-icon-16.svg')}}" class="header-user-avatar-dropdown-item-img" alt="" />
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('moncompte/mesmessages')}}">
                                    <img src="{{asset('images/mail-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Mes messages
                                </a>
                            </li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('myaccount.offers')}}">
                                    <img src="{{asset('images/list-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Mes annonces
                                </a>
                            </li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('myaccount.favorites')}}">
                                    <img src="{{asset('images/favourite-2765.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Mes favoris
                                </a>
                            </li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('propositions.index')}}">
                                    <img src="{{asset('images/exchange-44.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Mes propositions
                                </a>
                            </li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('transactions.index')}}">
                                    <img src="{{asset('images/shopping-bag-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Mes transactions
                                </a>
                            </li>
                            <!--
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="#">
                                    <img src="{{asset('images/shield-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    Crédibilité
                                </a>
                            </li> -->
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{route('binshopsblog.index' , 'fr')}}" style="color:#24A19C;font-weight: 900">
                                    <img src="{{asset('images/blog.png')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    BLOG
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <div class="header-user-avatar-dropdown-item">
                                    <div class="inline-block me-4 text-lg"> Pro </div>
                                    <label class="switch">
                                    <!-- <input  type="checkbox" wire:ignore wire:click="becomePro"> -->
                                    <input  type="checkbox"  {{$user->statusPro == "accepted" && $user->pro_on ? "checked" : ""}} readonly
                                        @if($user->statusPro == "pending")  
                                            wire:ignore
                                            wire:click="accountPro"
                                        @elseif($user->statusPro == "rejected" || $user->statusPro == "none")
                                            wire:ignore
                                            wire:click="becomePro"
                                        @else
                                            {{$user->pro_on = !$user->pro_on, $user->save()}}  
                                            onclick="changePro({{$user->pro_on}})" 
                                        @endif>
                                    <span class="slider round"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a
                                        class="header-user-avatar-dropdown-item" href="route('logout')"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <img src="{{asset('images/log-out-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Se déconnecter
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
                @guest
                <!-- Guest User -->
                <div id="header-guest-user">
                    <div class="dropdown" class="header-guest-user-content">
                        <button class="header-guest-user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/user-icon-24.svg') }} " alt="" class="" />
                            <span>S'authentifier</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end header-user-avatar-dropdown">
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{ route('login') }}">
                                    <img src="{{asset('images/user-icon-16.svg')}}" class="header-user-avatar-dropdown-item-img" alt="" />
                                    Se connecter
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{ route('register') }}">
                                    <img src="{{asset('images/user-plus-icon-24.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                    S'enregistrer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endguest
            </div>
            <div id="header-create-add-button">
                <a class="" href="{{ route('offer.create') }}">
                    <div class="header-create-add-button-img">
                        <img src="{{ asset('images/plus-icon-white.svg') }}" alt="" />
                    </div>
                    <span class="header-create-add-button-span">
                        Déposer <br />
                        une annonce
                    </span>
                </a>
            </div>
            <nav id="header-regions-dropdown-menu">
            <div class="header-regions-dropdown-menu-items">
                @if($regions)
                @foreach($regions as $region)
                @if(request()->is('offer.*'))
                @if(request()->has('category'))
    <a href="{{ route('offer.index', ['region' => $region->id,'category'=>request('category')]) }}" class="header-categories-dropdown-menu-item">
        <img  src="{{ asset('images/map-pin-icon.svg') }}" alt="" />
        <h3>{{ $region['name'] }}</h3>
    </a>
    @else
    <a href="{{ route('offer.index', ['region' => $region->id]) }}" class="header-categories-dropdown-menu-item">
        <img src="{{ asset('images/map-pin-icon.svg') }}" alt="" />
        <h3>{{ $region['name'] }}</h3>
    </a>
    @endif
@else
   
    @if(request()->has('category'))
    <a href="{{ route('alloffers.index', ['region' => $region->id,'category'=>request('category')]) }}" class="header-categories-dropdown-menu-item">
        <img src="{{ asset('images/map-pin-icon.svg') }}" alt="" />
        <h3>{{ $region['name'] }}</h3>
    </a>
    @else
    <a href="{{ route('alloffers.index', ['region' => $region->id]) }}" class="header-categories-dropdown-menu-item">
        <img src="{{ asset('images/map-pin-icon.svg') }}" alt="" />
        <h3>{{ $region['name'] }}</h3>
    </a>
    @endif
@endif

                @endforeach
                @endif
            </div>
        </nav>
        </div>
        <nav id="header-categories-dropdown-menu">
            <div class="header-categories-dropdown-menu-items">
                @if($parentcategories)
                @foreach($parentcategories as $parentcategory)
                <a href="{{ request()->is('offer.*') ? route('offer.index', ['category' => $parentcategory->id]) : route('alloffers.index', ['category' => $parentcategory->id]) }}" class="header-categories-dropdown-menu-item">
    <i class="fa {{$parentcategory['icon']}}"></i>
    <h3>{{ $parentcategory['name'] }}</h3>
</a>

                @endforeach
                @endif
            </div>
        </nav>
        <nav id="header-filter-dropdown-menu">
            <div class="header-filter-dropdown-menu-items">
            <form action="{{ request()->is('offer.*') ? route('offer.index') : route('alloffers.index') }}" method="GET">
            <label for="min_price">Prix minimal:</label>
<input type="number" name="min_price" id="min_price" step="0.01" min="0" placeholder="Entrez le prix minimal" required>
<label for="max_price">Prix maximal:</label>
<input type="number" name="max_price" id="max_price" step="0.01" min="0" placeholder="Entrez le prix maximal" required>
                @if(request()->has('region'))
                    <input type="hidden" name="region" value="{{ request('region') }}">
                @endif
                @if(request()->has('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button  id="filter" type="submit">
                    Filter
                </button>
            </form>
            </div>
        </nav>
        <nav id="header-search-dropdown-menu">
            <div class="header-search-dropdown-menu-items">
                <form class="flex flex-nowrap w-full"action="{{ request()->is('offer.*') ? route('offer.index') : route('alloffers.index') }}" method="GET">
                    <button type="button" id="header-search-location-btn">
                        <img id="region-icon" src="{{ asset('images/location-icon.svg') }} " alt="Localisation" />
                    </button>
                    <input id="header-search-input" type="search" name="query" placeholder="Rechercher un offre..." />
                    @if(request()->has('region'))
                        <input type="hidden" name="region" value="{{ request('region') }}">
                    @endif
                    <button id="header-search-submit" type="submit">
                        <img src="{{ asset('images/search-icon.svg') }}" alt="Recherche" />
                    </button>
                </form>
            </div>
        </nav>
       
    </header>
<!-- Add a script to handle marking as seen and deletion -->
<script>

    function changePro(pro_on){
        if(pro_on){
            Swal.fire({
                title: 'Vous avez activé votre compte proffessionel',
                timer: 2500,
                showCancelButton: false,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = "{{route('home')}}";
            });
        }else{
            Swal.fire({
                title: 'Vous avez activé votre compte particulier',
                timer: 2500,
                showCancelButton: false,
                showConfirmButton: false
            }).then((result) => {
                location.reload();
            });
        }
    }
    
</script>


