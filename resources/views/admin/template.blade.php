<x-app-layout>
   <!-- resources/views/admin/dashboard.blade.php -->
   <div class="flex h-screen relative">
      <!-- Sidebar -->
      <div class="w-1/4 bg-gray-800 p-4" >
         <h1 class="text-white text-2xl font-semibold mb-4">Tableau de bord de l'administrateur</h1>
         <ul class="p-0 lg:p-2">
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.users')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                  Liste des utilisateurs
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.update-information')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                  Informations
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.propositions')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>

                  Propositions
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.offers')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>

                  Offres
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.transactions')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>

                  Liste des transactions
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.resolving')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                  Resoudre/Informer
               </a>
            </li>

            <li class="mb-2 border-t-2 border-gray-700">
                <a href="{{route('admin.contest')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                    Contest
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
                <a href="#" id="toggleCampaigns" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                        <!-- Add a suitable icon for "Campagnes" -->
                        <!-- Example: Campaign Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s-4-1.5-8-4V6s3-3.5 8-3.5s8 3.5 8 3.5v12c-4 2.5-8 4-8 4Z" />
                    </svg>
                    
                <div class="d-flex  md:gap-10 lg:gap-20" >
                    <span >Campagnes</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                </a>
                <ul id="campaignsList" class="ml-4" style="display: none;">
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.campaigns')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Liste des campagnes" -->
                            <!-- Example: List Icon -->
                        
                            Liste des campagnes
                        </a>
                    </li>
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.add-campaign')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Ajouter Campagne" -->
                            <!-- Example: Add Icon -->
                        <div class="flex">
                        <div>Ajouter Campagne </div>  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg></div>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="mb-2 border-t-2 border-gray-700">
                <a href="#" id="toggleSponsors" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                    
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s-4-1.5-8-4V6s3-3.5 8-3.5s8 3.5 8 3.5v12c-4 2.5-8 4-8 4Z" />
                    </svg>
                    <div class="d-flex  md:gap-10 lg:gap-20" >
                        <span >Sponsors</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </a>
                <ul id="sponsorsList" class="ml-4" style="display: none;">
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.sponsors')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Liste des campagnes" -->
                            <!-- Example: List Icon -->
                        
                            Liste des sponsors
                        </a>
                    </li>
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.add-sponsor')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Ajouter Campagne" -->
                            <!-- Example: Add Icon -->
                        <div class="flex">
                        <div>Ajouter Sponsor </div>  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg></div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="absolute bottom-0 border-gray-70">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                
                    <button type="submit" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out w-6 h-6 mx-2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            
                            Logout
                    </button>
                </form>

            </li>
        </ul>
      </div>
      <!-- Main Content -->
      <div class="w-full p-4 overflow-auto">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline">
            <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
            </button>
            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
            <i class="fas fa-times"></i>
            </button>
            </div>
            </div>
            </form>
            </div>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">

            <div class="media">
            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
            <h3 class="dropdown-item-title">
            Brad Diesel
            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">Call me whenever you can...</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
            </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">

            <div class="media">
            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
            <h3 class="dropdown-item-title">
            John Pierce
            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">I got your message bro</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
            </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">

            <div class="media">
            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
            <h3 class="dropdown-item-title">
            Nora Silvester
            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">The subject goes here</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
            </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
            </li>
        </ul>
        </nav>
         @yield('admin-content')
      </div>
   </div>
</x-app-layout>
<script>
    document.getElementById('toggleCampaigns').addEventListener('click', function() {
        var campaignsList = document.getElementById('campaignsList');
        campaignsList.style.display = (campaignsList.style.display === 'none' || campaignsList.style.display === '') ? 'block' : 'none';
    });
    document.getElementById('toggleSponsors').addEventListener('click', function() {
        var campaignsList = document.getElementById('sponsorsList');
        campaignsList.style.display = (campaignsList.style.display === 'none' || campaignsList.style.display === '') ? 'block' : 'none';
    });
</script>