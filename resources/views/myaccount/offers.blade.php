<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Space') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>



    
    
    
    <h1>My Offers Space</h1>

    <div class="container">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nom de l'annonce
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date de création
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            catégorie
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prix
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @foreach ($offers as $offer)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$offer->name}}
                    </th>
                    <td class="px-6 py-4">
                        <img class="object-scale-down h-16 w-16 rounded" src="{{asset($offer->offer_default_photo)}}" alt="Annonce Image">
                    </td>
                    <td class="px-6 py-4">
                        {{$offer->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        {{$offer->type->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$offer->category->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$offer->price}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{route('myaccount.editOffer', [$offer->id])}}" class="no-underline font-medium text-blue-600 dark:text-blue-500">Modifier</a>
                        <a href="{{route('offer.offer', [$offer->id, $offer->slug])}}" class="no-underline font-medium text-blue-600 dark:text-blue-500">Voir offre</a>
                    </td>
                    </tr>
                </tbody>
                @endforeach
                
            </table>
        </div>
    </div>

        
        
</x-app-layout>