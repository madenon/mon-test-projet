<x-app-layout>
   <!-- resources/views/admin/dashboard.blade.php -->
   <div class="flex h-screen relative">
      <!-- Sidebar -->
      <div id="sidebar" class="bg-gray-800 p-4 w-80 hidden md:block overflow-auto">
      <h1 class="text-white text-md font-semibold mb-4 flex">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
              </svg>
            <span>Fais troquer</span>
         </h1>
         <ul class="p-0 lg:p-2 text-sm">
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.users')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Utilisateurs</span>
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.pro')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Pro</span>
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.update-information')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Informations</span>
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.offerInfos')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span>Offres infos</span>
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.blog')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Blog</span>
               </a>
            </li>
            <li class="mb-2 border-t-2 border-gray-700">
               <a href="{{route('admin.resolving')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span>Resoudre & Informer</span>
               </a>
            </li>

            <li class="mb-2 border-t-2 border-gray-700">
                <a href="{{route('admin.contests')}}" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span>Concours</span>
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
                    <span class="flex">Campagnes
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    </span>
                </div>
                </a>
                <ul id="campaignsList" class="ml-4 subtitle" style="display: none;">
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.campaigns')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Liste des campagnes" -->
                            <!-- Example: List Icon -->
                        
                            <span>Liste des campagnes</span>
                        </a>
                    </li>
                    <li class="mb-2 border-t-2 border-gray-700">
                        <a href="{{route('admin.add-campaign')}}" class="text-white hover:text-gray-300 py-2 no-underline">
                            <!-- Add a suitable icon for "Ajouter Campagne" -->
                            <!-- Example: Add Icon -->
                        <div class="flex">
                        <span>Ajouter Campagne </span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class=" border-gray-70">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                
                    <button type="submit" class="flex items-center text-white hover:text-gray-300 py-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out w-6 h-6 mx-2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            
                        <span>Logout</span>
                    </button>
                </form>

            </li>
        </ul>
      </div>
      <!-- Main Content -->
      <div class="w-full px-4 overflow-auto">
        <livewire:admin.navbar/>
        <div class="relative">
            <div id="control-sidebar" class="w-52 absolute right-0 h-full bg-black opacity-80 text-white z-10 hidden">
                <div>
                    Control Settings
                </div>
            </div>
             @yield('admin-content')
        </div>
      </div>
   </div>
   @yield('javascript')

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
    
    // $("li span").toggle();
    $("[data-widget=pushmenu]").click(function(){
        $("li span").toggle();
        $("h1 span").toggle();
        // $("li .subtitle").toggle();
    });
    $("[data-widget=control-sidebar]").click(function(){
        $("#control-sidebar").toggle();
    });
    
    
</script>