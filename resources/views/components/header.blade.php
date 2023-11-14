@props(['parentcategories'])
<header id="main-header">
        <div class="h-container">
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
                            src="{{ asset('images/list-icon-24.svg') }} "
                            alt=""
                            id="header-categories-button-button-icon" />
                        <span class="header-categories-button-button-span">Categories</span>
                </button>
            </div>
            <div id="header-search">
                <form action="{{ route('offer.index') }}" method="GET">
                    <button type="button" id="header-search-location-btn">
                        <img id="region-icon" src="{{ asset('images/location-icon.svg') }} " alt="Localisation" />
                    </button>
                    <input id="header-search-input" type="search" name="query" placeholder="Rechercher un truc..." />
                    @if(request()->has('region'))
                    <input type="hidden" name="region" value="{{ request('region') }}">
                    @endif
                    <button id="header-search-submit" type="submit">
                        <img src="{{asset('images/search-icon.svg')}}" alt="Recherche" />
                    </button>
                </form>
                <button id="header-search-icon-mobile">
                    <img src="{{asset('images/search-icon-dark.svg')}}" alt="" />
                </button>
            </div>
            <div id="header-filter">
                <button>
                    <img src="{{asset('images/filter-icon.svg')}}" alt="" />
                    <span>Filtre</span>
                </button>
            </div>
            <div id="header-user">
                @auth
                <!-- Authenticated User -->
                <div id="header-authenticated-user" class="">
                    <div class="dropdown" class="header-authenticated-user-content">
                        <div id="header-user-notification-icon" class="" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="header-user-notification-icon-notified"></div>
                        </div>
                        <ul class="dropdown-menu notification-dropdown">
                            <li>
                                <div class="notification-dropdown-item">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content">
                                        <a href="">
                                            <b>name</b>
                                            <span>Send you a proposition in </span>
                                            <strong>Range rover location...</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="notification-dropdown-item">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content">
                                        <a href="">
                                            <b>name</b>
                                            <span>Send you a proposition in </span>
                                            <strong>Range rover location...</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="notification-dropdown-item">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content">
                                        <a href="">
                                            <b>name</b>
                                            <span>Send you a proposition in </span>
                                            <strong>Range rover location...</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="notification-dropdown-item notification-dropdown-item-last-child">
                                    <div class="notification-dropdown-item-image">
                                        <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                                    </div>
                                    <div class="notification-dropdown-item-content">
                                        <a href="">
                                            <b>name</b>
                                            <span>Send you a proposition in </span>
                                            <strong>Range rover location...</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="header-user-messages-icon" class="">
                        <div class="header-user-messages-icon-newmessages"></div>
                    </div>
                    <div id="header-user-avatar-icon" >
                        <div class="dropdown">
                            <div class="" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{route('profile_pictures-file-path',$user->profile_photo_path)}}" alt="" class="header-user-avatar-icon-img rounded-full" />
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end header-user-avatar-dropdown">
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="{{route('myaccount.index')}}">
                                        <img src="{{asset('images/user-icon-16.svg')}}" class="header-user-avatar-dropdown-item-img" alt="" />
                                        Mon compte
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="{{asset('images/mail-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes messages
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="{{route('offer.index')}}">
                                        <img src="{{asset('images/list-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes annonces
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="{{route('propositions.index')}}">
                                        <img src="{{asset('images/list-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes propositions
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="{{asset('images/shopping-bag-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes transactions
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="{{asset('images/shield-icon-16.svg')}}" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Crédibilité
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
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
                <a href="{{ route('offer.index', ['region' => $region->id]) }}"  class="header-categories-dropdown-menu-item">
                    <img src="{{asset('images/map-pin-icon.svg')}}" alt="" />
                    <h3>{{$region['name']}}</h3>
                </a>
                @endforeach
                @endif
            </div>
        </nav>
        </div>
        <nav id="header-categories-dropdown-menu">
            <div class="header-categories-dropdown-menu-items">
                @if($parentcategories)
                @foreach($parentcategories as $parentcategory)
                <a href="{{ route('offer.index', ['category' => $parentcategory->id]) }}" class="header-categories-dropdown-menu-item">
                    <img src="{{asset('images/map-pin-icon.svg')}}" alt="" />
                    <h3>{{$parentcategory['name']}}</h3>
                </a>
                @endforeach
                @endif
            </div>
        </nav>
       
    </header>
