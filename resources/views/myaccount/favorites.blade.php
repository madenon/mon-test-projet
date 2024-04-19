<x-app-layout class="w-screen">
    <div class="container my-5 mx-4 h-screen">
        <div class="flex content-start justify-around w-screen">
            <div class="col-12 col-md-12 h-screen">
                <div class="container">
                    <h1>Mes favoris</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @if(count($favoriteOffers) > 0 && !$favoriteOffers->every('deleted_at'))
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
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($favoriteOffers as $offer)
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                                        {{$offer->title}}
                                        @if($offer->active_offer)
                                        <form method="POST" action="{{ route('offers.removeFromFavorites', ['offer' => $offer]) }}">
                                        @csrf
                                        @method('DELETE')
                                         <button type="submit">
                                           <i class="fas fa-heart text-red-600"></i>
                                            </button>
                                        </form>
                                        @else
                                            <form method="post" action="{{route('myaccount.activate', $offer)}}">
                                                @csrf
                                                @method('POST')
                                                <button class="text-white rounded-full h-8 w-8 bg-primary-color hover:bg-primary-hover" type="submit">M</button>
                                            </form>
                                        @endif
                                    </th>
                                    <td class="px-6 py-4">
                                        <img class="h-16 w-16 rounded-full" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt="Annonce Image">
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (!$offer->updated_at)
                                            {{$offer->created_at}}
                                        @else
                                            {{$offer->updated_at}}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$offer->type->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$offer->subcategory->parent->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$offer->price}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class=" bg-blue-700 hover:bg-blue-800 text-white font-bold h-12 w-24 rounded-full"><a class="no-underline font-medium text-white " href="{{route('offer.offer', [$offer->id, $offer->slug])}}">Voir offre</a></button>
                                    </td>
                                  
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        @else
                            <p>Vous n'avez aucune favori.</p>
                        @endif
                    </div>
                    <div class="py-4">
                        {{ $favoriteOffers->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

