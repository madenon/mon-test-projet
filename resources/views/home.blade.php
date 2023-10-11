<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if( Auth::user() && !Auth::user()->email_verified_at)
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class="font-bold">Be Warned</p>
                <p>Something not ideal might be happening.</p>
            </div>
            @endif
            {{ __('Index') }}
        </h2>

    </x-slot>

    <div class="">
        <div class="container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1>We are Home Page</h1>
                </div>
            </div>
        </div>
    </div>

    <h1>Home</h1>
</x-app-layout>
