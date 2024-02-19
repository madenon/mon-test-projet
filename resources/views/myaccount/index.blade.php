<x-app-layout>
    <div class="container">
        <div class="{{ auth()->user() ? 'flex' : 'flex justify-center' }} flex-col md:flex-row">
            @if(auth()->user())
                <div class="mt-16 col-12 col-md-3 bg-white w-full mb-6 shadow-lg rounded-xl">
                    <x-mini-menu ></x-mini-menu>
                </div>
                @endif
                <div class="col-12 col-md-9">
                    <x-user-info :user=$user ></x-user-info>
                </div>
            </div>
        </div>    
    </div>
        
</x-app-layout>