<x-app-layout>
   <!-- resources/views/admin/dashboard.blade.php -->


    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-800 p-4">
    <h1 class="text-white text-2xl font-semibold mb-4">Admin Dashboard</h1>
    <ul>
        <li class="mb-2 border-t-2 border-gray-700">
            <a href="{{route('admin.users')}}" class="flex items-center text-white hover:text-gray-300 py-2">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 6l3 9h12l3-9M10 14s2-2 5-2m-9 4h4"></path>
                </svg>
                User List
            </a>
        </li>
        <li class="mb-2 border-t-2 border-gray-700">
            <a href="{{route('admin.propositions')}}" class="flex items-center text-white hover:text-gray-300 py-2">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 6l3 9h12l3-9M10 14s2-2 5-2m-9 4h4"></path>
                </svg>
                Propositions
            </a>
        </li>
        <li class="mb-2 border-t-2 border-gray-700">
            <a href="{{route('admin.offers')}}" class="flex items-center text-white hover:text-gray-300 py-2">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 6l3 9h12l3-9M10 14s2-2 5-2m-9 4h4"></path>
                </svg>
                Offres
            </a>
        </li>
        <li class="mb-2 border-t-2 border-gray-700">
            <a href="{{route('admin.transactions')}}" class="flex items-center text-white hover:text-gray-300 py-2">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4-7m-4-4l4-7-4 7M7 21l4-7-4-4m0 0l-4 4 4 7"></path>
                </svg>
                Transaction List
            </a>
        </li>
        <!-- Add more links with icons and borders as needed -->
    </ul>
</div>


        <!-- Main Content -->
        <div class="w-3/4 p-4">
            <h2 class="text-2xl font-semibold mb-4">Welcome to the Admin Dashboard</h2>

            <!-- Your main content goes here -->

            <!-- Content from other pages -->
            @yield('admin-content')
        </div>
    </div>


</x-app-layout>

