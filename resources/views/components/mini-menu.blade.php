<ul class="space-y-2 font-medium mt-16">
    <li>
        <a class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->routeIs('profile.edit') ? 'font-bold' : '' }}">
            <img src="{{ route('profile_pictures-file-path', auth()->user()->avatar) }}"  class="rounded-full max-w-15 max-h-8" alt="{{ auth()->user()->name }} Avatar"/>
            <span class="ms-3">
                <div class="font-bold">{{auth()->user()->name}}</div>
                <div class="break-all">{{auth()->user()->email}}</div>
            </span>
        </a>
    </li>
    <li>
        <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->routeIs('profile.edit') ? 'font-bold' : '' }}">
            <img src="{{ asset('images/user-icon-16.svg') }}" class="header-user-avatar-dropdown-item-img" alt="" />
            <span class="ms-3">Informations personnelles</span>
        </a>
    </li>
    <li>
        <a href="{{ route('myaccount.offers') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->routeIs('myaccount.offers') ? 'font-bold' : '' }}">
            <img src="{{ asset('images/speech-bubble.svg') }}" class="header-user-avatar-dropdown-item-img w-4 h-4" alt="" />
            <span class="flex-1 ms-3 whitespace-nowrap">Mes trocs</span>
            <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"></span>
        </a>
    </li>
    <li>
        <a href="{{ route('moncompte/mesmessages') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->is('moncompte/mesmessages*') ? 'font-bold' : '' }}">
            <img src="{{ asset('images/exchange-44.svg') }}" class="header-user-avatar-dropdown-item-img w-4 h-4" alt="" />
            <span class="flex-1 ms-3 whitespace-nowrap">Mes messages</span>
        </a>
    </li>
  <!--  <li>
        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->routeIs('your.route.name') ? 'font-bold' : '' }}">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Amis</span>
        </a>
    </li> -->
    @if(auth()->user()->statusPro != "none")
    @if(auth()->user()->statusPro != "accepted" && auth()->user()->pro_on != false)
    <li>
        <a href="{{ route('myaccount.pro') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline {{ request()->routeIs('myaccount.pro') ? 'font-bold' : '' }}">
            <img src="{{ asset('images/speech-bubble.svg') }}" class="header-user-avatar-dropdown-item-img w-4 h-4" alt="" />
            <span class="flex-1 ms-3 whitespace-nowrap">compte Pro</span>
            <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"></span>
        </a>
    </li>
    @endif
    @endif
</ul>
