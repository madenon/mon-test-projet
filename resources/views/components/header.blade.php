<header id="main-header">
        <div class="h-container">
            <div id="header-logo" class="">
                <a href="">
                    <img src="images/logo-faistroquerfr.svg" alt="Logo faistroquer.fr" class="logo-desktop" />
                    <img src="images/logo-mobile.svg" alt="Logo faistroquer.fr" class="logo-mobile" />
                </a>
            </div>
            <div id="header-categories-button">
                <button 
                    id="header-categories-button-btn" 
                    class="header-categories-button-button">
                        <img 
                            src="images/list-icon-24.svg" 
                            alt="" 
                            id="header-categories-button-button-icon" /> 
                        <span class="header-categories-button-button-span">Categories</span>
                </button>
            </div>
            <div id="header-search">
                <form>
                    <button id="header-search-location-btn">
                        <img src="{{ asset('images/location-icon.svg') }} " alt="Localisation" />
                    </button>
                    <input id="header-search-input" type="search" placeholder="Rechercher un truc..." />
                    <button id="header-search-submit" type="submit">
                        <img src="images/search-icon.svg" alt="Recherche" />
                    </button>
                </form>
                <button id="header-search-icon-mobile">
                    <img src="images/search-icon-dark.svg" alt="" />
                </button>
            </div>
            <div id="header-filter">
                <button>
                    <img src="images/filter-icon.svg" alt="" />
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
                                        <img src="images/circle-user-icon.svg" alt="" />
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
                                        <img src="images/circle-user-icon.svg" alt="" />
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
                                        <img src="images/circle-user-icon.svg" alt="" />
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
                                        <img src="images/circle-user-icon.svg" alt="" />
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
                                <img src="images/user-avatar-icon.svg" alt="" class="header-user-avatar-icon-img" />
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end header-user-avatar-dropdown">
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="images/user-icon-16.svg" class="header-user-avatar-dropdown-item-img" alt="" />
                                        Mon compte
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="images/mail-icon-16.svg" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes messages
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="images/list-icon-16.svg" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes annonces
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="images/shopping-bag-icon-16.svg" alt="" class="header-user-avatar-dropdown-item-img" />
                                        Mes transactions
                                    </a>
                                </li>
                                <li>
                                    <a class="header-user-avatar-dropdown-item" href="#">
                                        <img src="images/shield-icon-16.svg" alt="" class="header-user-avatar-dropdown-item-img" />
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
                                            <img src="images/log-out-icon-16.svg" alt="" class="header-user-avatar-dropdown-item-img" />
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
                            <img src="images/user-icon-24.svg" alt="" class="" /> 
                            <span>S'authentifier</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end header-user-avatar-dropdown">
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{ route('login') }}">
                                    <img src="images/user-icon-16.svg" class="header-user-avatar-dropdown-item-img" alt="" />
                                    Se connecter
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="header-user-avatar-dropdown-item" href="{{ route('register') }}">
                                    <img src="images/user-plus-icon-24.svg" alt="" class="header-user-avatar-dropdown-item-img" />
                                    S'enregistrer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endguest
            </div>
            
            <div id="header-create-add-button">
                <button class="">
                    <div class="header-create-add-button-img">
                        <img src="images/plus-icon-white.svg" alt="" />
                    </div>
                    <span>
                        Déposer <br />
                        une annonce
                    </span>
                </button>
            </div>
        </div>
        <nav id="header-categories-dropdown-menu">
            <div class="header-categories-dropdown-menu-items">
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="images/map-pin-icon.svg" alt="" />
                    <h3>Immobilier</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Véhicules</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Bricolage</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Multimédia</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Mode</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Maison</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Jardin & Plantes</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Librairie & Papeterie</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Animaux</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Alimentation</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Sports & Loisirs</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Beauté & Bien-être</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Enfance</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Art & Spectacle</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Collection</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Billetterie</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Matériel professionnel</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>CD, Vinyles & Cassettes</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Seniors & Handicap</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Emploi</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Divers</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Immobilier</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Immobilier</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Emploi</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Divers</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Immobilier</h3>
                </a>
                <a href="" class="header-categories-dropdown-menu-item">
                    <img src="{{ asset('images/map-pin-icon.svg') }} " alt="" />
                    <h3>Immobilier</h3>
                </a>
            </div>
        </nav>
    </header>